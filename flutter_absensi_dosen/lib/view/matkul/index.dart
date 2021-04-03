import 'package:flutter/material.dart';

class MatkulView extends StatefulWidget {
  @override
  _MatkulViewState createState() => _MatkulViewState();
}

class _MatkulViewState extends State<MatkulView> {
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text('Mata Kuliah'),
      ),
      body: Container(
        padding: EdgeInsets.all(10),
        child: Column(
          children: [
            Card(
              color: Colors.blue,
              // margin: EdgeInsets.all(10),
              child: Container(
                width: double.infinity,
                //   padding: EdgeInsets.all(10),
                child: Column(
                  crossAxisAlignment: CrossAxisAlignment.start,
                  children: [
                    Text('Nama Mata Kuliah :'),
                    Text('Nama Mata Kuliah :'),
                    Text('Nama Mata Kuliah :'),
                  ],
                ),
              ),
            ),
            ElevatedButton(onPressed: () {}, child: Text('Absensi Masuk')),
            
          ],
        ),
      ),
    );
  }
}
