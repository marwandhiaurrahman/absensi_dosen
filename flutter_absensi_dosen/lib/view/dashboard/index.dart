import 'package:flutter/material.dart';
import 'package:backdrop/backdrop.dart';
import 'package:flutter_absensi_dosen/dummy_data/matkul.dart';
import 'package:flutter_absensi_dosen/view/dashboard/front_layer.dart';
import 'package:responsive_size/responsive_size.dart';

class DashboardView extends StatefulWidget {
  @override
  _ViewDashboardState createState() => _ViewDashboardState();
}

class _ViewDashboardState extends State<DashboardView> {
  @override
  Widget build(BuildContext context) {
    ResponsiveSize.init(
        designWidth: MediaQuery.of(context).size.width,
        designHeight: MediaQuery.of(context).size.height);

    return BackdropScaffold(
      backLayer: Center(
        child: Text('backLayer'),
      ),
      frontLayer: FrontLayer(),
      appBar: BackdropAppBar(
        title: Text('Dashboard'),
        actions: [
          IconButton(onPressed: () => _logoutButton(), icon: Icon(Icons.logout))
        ],
      ),
    );
  }

  void _logoutButton() {
    print('logout');
    Navigator.pushNamedAndRemoveUntil(context, '/login', (route) => false);
  }
}
