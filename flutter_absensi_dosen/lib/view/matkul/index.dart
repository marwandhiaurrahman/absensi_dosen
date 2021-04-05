import 'package:flutter/material.dart';
import 'package:flutter_absensi_dosen/endpoint/dashboard.dart';

class MatkulView extends StatefulWidget {
  final Jadwal jadwal;
  final int index;
  const MatkulView({this.jadwal, this.index});

  @override
  _MatkulViewState createState() => _MatkulViewState();
}

class _MatkulViewState extends State<MatkulView> {
  // int _rowsPerPage = PaginatedDataTable.defaultRowsPerPage;
  bool status = true;

  void _absensiMasuk() {
    Navigator.pushNamed(context, '/absensi');
  }

  void _absensiKeluar() {
    Navigator.pushNamed(context, '/absensi');
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
                      Text('Ruangan : ' +
                          widget.jadwal.ruangan.kode +
                          ' Lantai ' +
                          widget.jadwal.ruangan.lantai.toString()),
                    ],
                  ),
                ),
              ),
              (status)
                  ? ElevatedButton(
                      onPressed: () {
                        _absensiMasuk();
                      },
                      style: ElevatedButton.styleFrom(
                        primary: Colors.green, // background
                      ),
                      child: Text('Absensi Masuk'))
                  : ElevatedButton(
                      onPressed: () {
                        _absensiKeluar();
                      },
                      style: ElevatedButton.styleFrom(
                        primary: Colors.red, // background
                      ),
                      child: Text(
                        'Absensi Keluar',
                      )),
              PaginatedDataTable(
                header: Text('Data Absensi'),
                // rowsPerPage: _rowsPerPage,
                // availableRowsPerPage: const <int>[5, 10, 20],
                // onRowsPerPageChanged: (int value) {
                //   setState(() {
                //     _rowsPerPage = value;
                //   });
                // },
                columns: kTableColumns,
                source: DessertDataSource(),
              )
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
    label: Text('Pembahasan'),
  ),
  DataColumn(
    label: Text('Jam Masuk'),
  ),
  DataColumn(
    label: Text('Jam Keluar'),
  ),
  DataColumn(
    label: Text('Keterangan'),
  ),
];

////// Data class.
class Dessert {
  Dessert(this.name, this.calories, this.fat, this.carbs, this.protein,
      this.sodium, this.calcium, this.iron);
  final String name;
  final int calories;
  final double fat;
  final int carbs;
  final double protein;
  final int sodium;
  final int calcium;
  final int iron;
  // bool selected = false;
}

class Absensi {
  Absensi(
    this.pertemuan,
    this.pembahasan,
    this.jamMasuk,
    this.jamKeluar,
    this.keterangan,
  );
  final String pertemuan;
  final String pembahasan;
  final String jamMasuk;
  final String jamKeluar;
  final String keterangan;
  // bool selected = false;
}

////// Data source class for obtaining row data for PaginatedDataTable.
class DessertDataSource extends DataTableSource {
  int _selectedCount = 0;
  final List<Absensi> _data = <Absensi>[
    Absensi('Pertemuan 1', 'Belajar 1', '08.00', '10.00', 'keterangan'),
    Absensi('Pertemuan 2', 'Belajar 1', '08.00', '10.00', 'keterangan'),
    Absensi('Pertemuan 3', 'Belajar 1', '08.00', '10.00', 'keterangan'),
    Absensi('Pertemuan 4', 'Belajar 1', '08.00', '10.00', 'keterangan'),
    Absensi('Pertemuan 5', 'Belajar 1', '08.00', '10.00', 'keterangan'),
    Absensi('Pertemuan 6', 'Belajar 1', '08.00', '10.00', 'keterangan'),
    Absensi('Pertemuan 7', 'Belajar 1', '08.00', '10.00', 'keterangan'),
    Absensi('Pertemuan 8', 'Belajar 1', '08.00', '10.00', 'keterangan'),
    Absensi('Pertemuan 8', 'Belajar 1', '08.00', '10.00', 'keterangan'),
    Absensi('Pertemuan 8', 'Belajar 1', '08.00', '10.00', 'keterangan'),
    Absensi('Pertemuan 8', 'Belajar 1', '08.00', '10.00', 'keterangan'),
    Absensi('Pertemuan 8', 'Belajar 1', '08.00', '10.00', 'keterangan'),
    Absensi('Pertemuan 8', 'Belajar 1', '08.00', '10.00', 'keterangan'),
    Absensi('Pertemuan 8', 'Belajar 1', '08.00', '10.00', 'keterangan'),
    Absensi('Pertemuan 8', 'Belajar 1', '08.00', '10.00', 'keterangan'),
    Absensi('Pertemuan 8', 'Belajar 1', '08.00', '10.00', 'keterangan'),
    Absensi('Pertemuan 8', 'Belajar 1', '08.00', '10.00', 'keterangan'),
    Absensi('Pertemuan 8', 'Belajar 1', '08.00', '10.00', 'keterangan'),
    Absensi('Pertemuan 8', 'Belajar 1', '08.00', '10.00', 'keterangan'),
    Absensi('Pertemuan 8', 'Belajar 1', '08.00', '10.00', 'keterangan'),
    Absensi('Pertemuan 8', 'Belajar 1', '08.00', '10.00', 'keterangan'),
    Absensi('Pertemuan 8', 'Belajar 1', '08.00', '10.00', 'keterangan'),
    Absensi('Pertemuan 8', 'Belajar 1', '08.00', '10.00', 'keterangan'),
    Absensi('Pertemuan 8', 'Belajar 1', '08.00', '10.00', 'keterangan'),
  ];

  @override
  DataRow getRow(int index) {
    assert(index >= 0);
    if (index >= _data.length) return null;
    final Absensi dessert = _data[index];
    return DataRow.byIndex(index: index,
        // selected: dessert.selected,
        // onSelectChanged: (bool value) {
        //   if (dessert.selected != value) {
        //     _selectedCount += value ? 1 : -1;
        //     assert(_selectedCount >= 0);
        //     dessert.selected = value;
        //     notifyListeners();
        //   }
        // },
        cells: <DataCell>[
          DataCell(Text(dessert.pertemuan)),
          DataCell(Text(dessert.pembahasan)),
          DataCell(Text(dessert.jamMasuk)),
          DataCell(Text(dessert.jamKeluar)),
          DataCell(Text(dessert.keterangan)),
        ]);
  }

  @override
  int get rowCount => _data.length;

  @override
  bool get isRowCountApproximate => false;

  @override
  int get selectedRowCount => _selectedCount;
}
