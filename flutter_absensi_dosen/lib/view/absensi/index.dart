import 'dart:async';

import 'package:flutter/material.dart';
import 'package:permission_handler/permission_handler.dart';
import 'package:responsive_size/responsive_size.dart';
import 'package:qrscan/qrscan.dart' as scanner;
import 'package:geolocator/geolocator.dart';
import 'package:intl/intl.dart';

class AbsensiView extends StatefulWidget {
  @override
  _AbsensiViewState createState() => _AbsensiViewState();
}

class _AbsensiViewState extends State<AbsensiView> {
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

  Future _scan() async {
    await Permission.camera.request();
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
    await Geolocator.requestPermission().then((value) => {
          setState(() {
            _permissionLocation = value.toString();
          })
        });
  }

  void _getLocation() async {
    _requestPermissionLocation();
    await Geolocator.getCurrentPosition().then((value) => {
          setState(() {
            _akurasiLokasi = value.accuracy;
            latitude = value.latitude;
            longitude = value.longitude;
            jarak = Geolocator.distanceBetween(
                -6.9699184274322175, 108.52827343642505, latitude, longitude);
          })
        });
  }

  String output = 'Belum Scan Absensi';
  String _permissionLocation = 'Belum Scan Absensi';
  double _akurasiLokasi = 0;
  double latitude = 0;
  double longitude = 0;
  double jarak = 0;
  String _timeString;

  @override
  void initState() {
    _timeString = _formatDateTime(DateTime.now());
    Timer.periodic(Duration(seconds: 1), (Timer t) => _getTime());
    super.initState();
  }

  @override
  Widget build(BuildContext context) {
    ResponsiveSize.init(
        designWidth: MediaQuery.of(context).size.width,
        designHeight: MediaQuery.of(context).size.height);
    return Scaffold(
      appBar: AppBar(
        title: Text('Absensi Masuk'),
      ),
      body: Column(
        children: [
          Card(
              child: Container(
            // color: Colors.blue[200],
            width: double.infinity,
            padding: EdgeInsets.all(spBlock * 1),
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                Text('Tanggal : ' + _timeString),
                Text('Tanggal : 12 Januari 2021'),
                Text('Tanggal : 12 Januari 2021'),
              ],
            ),
          )),
          Card(
              child: Container(
            // color: Colors.blue[200],
            width: double.infinity,
            padding: EdgeInsets.all(spBlock * 1),
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                Text('Ruangan : ' + output),
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
                  _scan();
                  _getLocation();
                },
                child: Text('Scan'),
                style: ElevatedButton.styleFrom(
                    primary: Colors.amber, onPrimary: Colors.black),
              ),
            ),
          ),
          Container(
            width: double.infinity,
            child: Card(
              color: Colors.transparent,
              elevation: 0,
              child: ElevatedButton(
                onPressed: () {},
                child: Text('Upload'),
                style: ElevatedButton.styleFrom(
                  primary: Colors.lightGreen,
                ),
              ),
            ),
          )
        ],
      ),
    );
  }
}
