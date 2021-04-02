import 'package:flutter/material.dart';
import 'package:backdrop/backdrop.dart';

class ViewDashboard extends StatefulWidget {
  @override
  _ViewDashboardState createState() => _ViewDashboardState();
}

class _ViewDashboardState extends State<ViewDashboard> {
  @override
  Widget build(BuildContext context) {
    return BackdropScaffold(
      backLayer: Center(
        child: Text('backLayer'),
      ),
      frontLayer: Center(
        child: Text('Frontlayer'),
      ),
      appBar: BackdropAppBar(
        title: Text('Dashboard'),
      ),
    );
  }
}
