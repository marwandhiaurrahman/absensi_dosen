import 'package:flutter/material.dart';
import 'package:flutter_absensi_dosen/controller/api_controller.dart';
import 'package:flutter_absensi_dosen/model/absensi.dart';
import 'package:flutter_absensi_dosen/model/hari.dart';
import 'package:flutter_absensi_dosen/model/jadwal.dart';
import 'package:flutter_absensi_dosen/view/absensi/masuk.dart';
import 'package:flutter_absensi_dosen/view/absensi/keluar.dart';

class MatkulView extends StatefulWidget {
  final Jadwal jadwal;
  final int index;
  const MatkulView({this.jadwal, this.index});

  @override
  _MatkulViewState createState() => _MatkulViewState();
}

class _MatkulViewState extends State<MatkulView> {
  // int _rowsPerPage = PaginatedDataTable.defaultRowsPerPage;

  ApiController apiController = ApiController();
  bool status = true;

  void _absensiMasuk(Matkul matkul) {
    Navigator.push(
        context,
        MaterialPageRoute(
            builder: (context) => AbsensiMasuk(
                  matkul: matkul,
                )));
  }

  void absensiKeluar(AbsensiElement a) {
    Navigator.push(
        context,
        MaterialPageRoute(
            builder: (context) => AbsensiKeluar(
                  absensi: a,
                )));
  }

  @override
  void initState() {
    // widget.jadwal;
    super.initState();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text('Jadwal Mata Kuliah'),
      ),
      body: SingleChildScrollView(
        child: Container(
          padding: EdgeInsets.all(10),
          child: Column(
            children: [
              Card(
                // margin: EdgeInsets.all(10),
                child: Container(
                  width: double.infinity,
                  padding: EdgeInsets.all(10),
                  child: Column(
                    crossAxisAlignment: CrossAxisAlignment.start,
                    children: [
                      Text('Informasi Mata Kuliah :'),
                      Text('Kode : ' + widget.jadwal.matkul.kode),
                      Text('Nama : ' + widget.jadwal.matkul.name),
                      Text('Dosen Pengajar : ' +
                          widget.jadwal.matkul.dosen.name),
                      Text('Kelas : ' + widget.jadwal.kelas.kode),
                      SizedBox(height: 10),
                      Text('Hari : ' + hari[int.parse(widget.jadwal.hari)]),
                      Text('Waktu : ' +
                          widget.jadwal.jamkul.masuk +
                          ' - ' +
                          widget.jadwal.jamkul.keluar +
                          ' WIB'),
                      Text('Ruangan : ' +
                          widget.jadwal.ruangan.kode +
                          ' Lantai ' +
                          widget.jadwal.ruangan.lantai.toString()),
                    ],
                  ),
                ),
              ),
              FutureBuilder(
                future: apiController.getabsensi(widget.index),
                builder: (BuildContext context, AsyncSnapshot snapshot) {
                  if (snapshot.hasError) {
                    return Center(
                      child: Text('Error : ' + snapshot.error.toString()),
                    );
                  } else if (snapshot.connectionState == ConnectionState.done) {
                    Absensi absensi = snapshot.data;
                    return Column(
                      children: [
                        Card(
                          child: Container(
                            width: double.infinity,
                            padding: EdgeInsets.all(10),
                            child: (absensi.absensiAktif.length >= 1)
                                ? Column(
                                    children: [
                                      Text(
                                          'Informasi absensi yang sedang aktif ' +
                                              absensi.absensiAktif.length
                                                  .toString()),
                                      for (var item in absensi.absensiAktif)
                                        Column(
                                          children: [
                                            Text('Pertemuan ' + item.pertemuan),
                                            ElevatedButton(
                                                style: ElevatedButton.styleFrom(
                                                    primary: Colors.red),
                                                onPressed: () {
                                                  absensiKeluar(item);
                                                },
                                                child: Text('Absensi Keluar')),
                                          ],
                                        ),
                                    ],
                                  )
                                : Column(
                                    children: [
                                      Text('Silahkan melakukan absensi'),
                                      ElevatedButton(
                                          style: ElevatedButton.styleFrom(
                                              primary: Colors.green),
                                          onPressed: () {
                                            _absensiMasuk(widget.jadwal.matkul);
                                          },
                                          child: Text('Absensi Masuk')),
                                    ],
                                  ),
                          ),
                        ),
                        PaginatedDataTable(
                          columns: kTableColumns,
                          source: AbsensiDataSource(absensi: absensi.absensi),
                        )
                      ],
                    );
                  } else {
                    return Center(child: CircularProgressIndicator());
                  }
                },
              ),
            ],
          ),
        ),
      ),
    );
  }
}

////// Columns in table.
const kTableColumns = <DataColumn>[
  DataColumn(
    label: Text('Pertemuan'),
  ),
  DataColumn(
    label: Text('Tanggal'),
  ),
  DataColumn(
    label: Text('Metode'),
  ),
  DataColumn(
    label: Text('Pembahasan'),
  ),
  DataColumn(
    label: Text('Jam Masuk'),
  ),
  DataColumn(
    label: Text('Jam Keluar'),
  ),
  DataColumn(
    label: Text('Jarak'),
  ),
];

////// Data source class for obtaining row data for PaginatedDataTable.
class AbsensiDataSource extends DataTableSource {
  AbsensiDataSource({
    @required this.absensi,
  });

  int _selectedCount = 0;

  List<AbsensiElement> absensi;

  @override
  DataRow getRow(int index) {
    assert(index >= 0);
    if (index >= this.absensi.length) return null;
    final AbsensiElement absensi = this.absensi[index];
    return DataRow.byIndex(index: index, cells: <DataCell>[
      DataCell(Text('Pertemuan ' + absensi.pertemuan.toString())),
      DataCell(Text(absensi.tanggal.toString())),
      DataCell(Text(absensi.metode.toString())),
      DataCell(Text(absensi.pembahasan.toString())),
      DataCell(Text(absensi.masuk.toString())),
      DataCell(Text(absensi.keluar.toString())),
      DataCell(Text(absensi.jarak.toString())),
    ]);
  }

  @override
  int get rowCount => this.absensi.length;

  @override
  bool get isRowCountApproximate => false;

  @override
  int get selectedRowCount => _selectedCount;
}
