import 'package:flutter/material.dart';
import 'package:backdrop/backdrop.dart';
import 'package:flutter_absensi_dosen/dummy_data/matkul.dart';
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
      frontLayer: Container(
        margin: EdgeInsets.all(spBlock * 0.5),
        child: SingleChildScrollView(
          child: Column(
            children: [
              Text(
                'Marwan Dhiaur Rahman',
                style: TextStyle(fontSize: spBlock * 1.1),
              ),
              Card(
                  child: Container(
                // color: Colors.blue[200],
                width: double.infinity,
                padding: EdgeInsets.all(spBlock * 1),
                child: Column(
                  crossAxisAlignment: CrossAxisAlignment.start,
                  children: [
                    Text('Tanggal : 12 Januari 2021'),
                    Text('Tanggal : 12 Januari 2021'),
                    Text('Tanggal : 12 Januari 2021'),
                  ],
                ),
              )),
              Card(
                child: ExpansionTile(
                  initiallyExpanded: true,
                  title: Text('Jadwal Hari Ini'),
                  leading: Icon(Icons.menu),
                  children: matkulToday
                      .map((e) => Container(
                            child: Column(
                              children: [
                                Container(
                                  margin: EdgeInsets.symmetric(
                                      horizontal: widthBlock * 5),
                                  child: Divider(
                                    color: Colors.black,
                                  ),
                                ),
                                ListTile(
                                  title: Text(e.name),
                                  subtitle: Text(e.waktu),
                                  leading: Icon(Icons.book),
                                  onTap: () {},
                                ),
                              ],
                            ),
                          ))
                      .toList(),
                ),
              ),
              Card(
                child: ListTile(
                  title: Text('Jadwal Mata Kuliah'),
                  leading: Icon(Icons.menu),
                  onTap: () {
                    print('jadwal');
                    Navigator.pushNamed(context, '/jadwal');
                  },
                ),
              ),
            ],
          ),
        ),
      ),
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
