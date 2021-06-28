import 'dart:async';

import 'package:flutter/material.dart';
import 'package:flutter_absensi_dosen/controller/api_controller.dart';
import 'package:flutter_absensi_dosen/endpoint/dashboard.dart';
import 'package:flutter_absensi_dosen/model/absensi.dart';
// import 'package:flutter_absensi_dosen/model/jadwal.dart';
import 'package:flutter_absensi_dosen/view/dashboard/index.dart';
import 'package:permission_handler/permission_handler.dart';
import 'package:responsive_size/responsive_size.dart';
import 'package:qrscan/qrscan.dart' as scanner;
import 'package:geolocator/geolocator.dart';
import 'package:intl/intl.dart';

class AbsensiKeluar extends StatefulWidget {
  final AbsensiElement absensi;
  final Jadwal jadwal;
  final Matkul matkul;
  const AbsensiKeluar({this.absensi, this.jadwal, this.matkul});

  @override
  _AbsensiKeluarState createState() => _AbsensiKeluarState();
}

class _AbsensiKeluarState extends State<AbsensiKeluar> {
  void _getTime() {
    final DateTime now = DateTime.now();
    final String formattedDateTime = _formatDateTime(now);
    setState(() {
      _timeString = formattedDateTime;
    });
  }

  String _formatDateTime(DateTime dateTime) {
    return DateFormat('MM/dd/yyyy HH:mm:ss').format(dateTime);
  }

  String _timeString;

  Future _scan(double lat, double long) async {
    await Permission.camera.request();
    _getLocation(lat, long);
    String barcode = await scanner.scan();
    if (barcode == null) {
      print('nothing return.');
    } else {
      setState(() {
        output = barcode;
        print(barcode);
      });
    }
  }

  void _requestPermissionLocation() async {
    await Permission.locationAlways.request().then((value) => {
          setState(() {
            _permissionLocation = value.toString();
          })
        });
  }

  void _getLocation(double lat, double long) async {
    _requestPermissionLocation();
    await Geolocator.getCurrentPosition().then((value) => {
          setState(() {
            _akurasiLokasi = value.accuracy;
            latitude = value.latitude;
            longitude = value.longitude;
            jarak = Geolocator.distanceBetween(lat, long, latitude, longitude);
          })
        });
  }

  void _uploadAbsensi() {
    print(this.widget.absensi.id);
    apiController
        .absensikeluar(
            widget.absensi.id,
            DateTime.now().toString(),
            metode,
            pembahasanController.text,
            widget.jadwal.id,
            latitude,
            longitude,
            jarak)
        .then((value) {
      print('value ' + value['success'].toString());
    });
    Navigator.pushAndRemoveUntil(
        context,
        MaterialPageRoute(builder: (context) => DashboardView()),
        (Route<dynamic> route) => false);

    // apiController.absensimasuk(DateTime.now().toString(), metode,
    //     pembahasanController.text, widget.jadwal.id, latitude, longitude);
  }

  ApiController apiController = ApiController();

  String output;
  String _permissionLocation = 'Belum Scan Absensi';
  double _akurasiLokasi = 0;
  double latitude = 0;
  double longitude = 0;
  double reflat = 0;
  double reflong = 0;
  double jarak = 0;
  String metode;
  final pembahasanController = TextEditingController();

  @override
  void initState() {
    apiController.getlocation().then((value) {
      print(value['latitude']);
      reflat = value['latitude'];
      reflong = value['longitude'];
      print('lat' + reflat.toString());
    });
    _timeString = _formatDateTime(DateTime.now());
    // Timer.periodic(Duration(seconds: 1), (Timer t) => _getTime());
    metode = widget.absensi.metode;
    pembahasanController.text = widget.absensi.pembahasan;
    super.initState();
  }

  @override
  void dispose() {
    _timeString = _formatDateTime(DateTime.now());
    super.dispose();
  }

  @override
  Widget build(BuildContext context) {
    const itemsMenu = <String>[
      'Tatap Muka',
      'E-Class',
    ];
    ResponsiveSize.init(
        designWidth: MediaQuery.of(context).size.width,
        designHeight: MediaQuery.of(context).size.height);
    return Scaffold(
      appBar: AppBar(
        title: Text('Absensi Keluar'),
      ),
      body: SingleChildScrollView(
        child: Column(
          children: [
            Card(
                child: Container(
              width: double.infinity,
              padding: EdgeInsets.all(spBlock * 1),
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  Text('Pertemuan ke - ' + widget.absensi.pertemuan.toString()),
                  Text('Mata Kuliah : ' + widget.matkul.name),
                  Text('Kode : ' + widget.jadwal.kode),
                  Text('Dosen : ' + widget.matkul.dosen.name),
                  Text('Tanggal : ' + _timeString),
                ],
              ),
            )),
            Card(
                child: Container(
              width: double.infinity,
              padding: EdgeInsets.all(spBlock * 1),
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  TextFormField(
                    controller: pembahasanController,
                    maxLines: 2,
                    textInputAction: TextInputAction.next,
                    decoration: InputDecoration(
                        border: OutlineInputBorder(
                          borderRadius: const BorderRadius.all(
                            const Radius.circular(10.0),
                          ),
                        ),
                        filled: true,
                        labelText: 'Materi',
                        hintStyle: TextStyle(color: Colors.grey[800]),
                        hintText: "Masukan Materi",
                        fillColor: Colors.white70),
                  ),
                  Container(
                    margin: EdgeInsets.symmetric(
                      vertical: 10,
                    ),
                    width: double.infinity,
                    decoration: ShapeDecoration(
                      shape: RoundedRectangleBorder(
                        side: BorderSide(width: 1.0, style: BorderStyle.solid),
                        borderRadius: BorderRadius.all(Radius.circular(10.0)),
                      ),
                    ),
                    child: DropdownButtonHideUnderline(
                      child: Container(
                        margin: EdgeInsets.only(left: 10.0, right: 10.0),
                        child: DropdownButton<String>(
                          hint: Text('Pilih Metode'),
                          value: metode,
                          items: itemsMenu.map((String value) {
                            return DropdownMenuItem<String>(
                              value: value,
                              child: Text(value),
                            );
                          }).toList(),
                          onChanged: (value) {
                            setState(() {
                              metode = value;
                            });
                          },
                        ),
                      ),
                    ),
                  ),
                ],
              ),
            )),
            Card(
                child: Container(
              width: double.infinity,
              padding: EdgeInsets.all(spBlock * 1),
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  (output == null)
                      ? Text('Ruangan : Belum Melakukan Scan')
                      : Text('Ruangan : ' + output),
                  Text(_permissionLocation),
                  Text('Latitude : ' + latitude.toString()),
                  Text('Longitude : ' + longitude.toString()),
                  Text('Jarak : ' + jarak.ceilToDouble().toString() + ' meter'),
                  Text('Akurasi : ' +
                      (100 - _akurasiLokasi.ceilToDouble()).toString() +
                      ' %'),
                ],
              ),
            )),
            Container(
              width: double.infinity,
              child: Card(
                color: Colors.transparent,
                elevation: 0,
                child: ElevatedButton(
                  onPressed: () {
                    _scan(reflat, reflong);
                  },
                  child: Text('Scan'),
                  style: ElevatedButton.styleFrom(
                      primary: Colors.amber, onPrimary: Colors.black),
                ),
              ),
            ),
            (output == null)
                ? Text('Silahkan scan barcode absensi dikelas')
                : Container(
                    width: double.infinity,
                    child: Card(
                      color: Colors.transparent,
                      elevation: 0,
                      child: ElevatedButton(
                        onPressed: () {
                          _uploadAbsensi();
                        },
                        child: Text('Submit'),
                        style: ElevatedButton.styleFrom(
                          primary: Colors.lightGreen,
                        ),
                      ),
                    ),
                  )
          ],
        ),
      ),
    );
  }
}
