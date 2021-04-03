import 'package:flutter/material.dart';

class AbsensiView extends StatefulWidget {
  @override
  _AbsensiViewState createState() => _AbsensiViewState();
}

class _AbsensiViewState extends State<AbsensiView> {
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text('Absensi Masuk'),
      ),
      body: Center(
        child: Text('Absensi'),
      ),
    );
  }
}
