import 'package:flutter/material.dart';
import 'package:flutter_absensi_dosen/dummy_data/matkul.dart';
import 'package:grouped_list/grouped_list.dart';

class JadwalView extends StatefulWidget {
  @override
  _JadwalViewState createState() => _JadwalViewState();
}

class _JadwalViewState extends State<JadwalView> {
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text('Jadwal Mata Kuliah'),
      ),
      body: GroupedListView<dynamic, String>(
        elements: jadwalMatkul,
        groupBy: (element) => element.hari,
        // groupComparator: (value1, value2) => value2.compareTo(value1),
        // itemComparator: (item1, item2) =>
        //     item1['name'].compareTo(item2['name']),
        order: GroupedListOrder.DESC,
        // useStickyGroupSeparators: true,
        groupSeparatorBuilder: (value) {
          return Text(value);
        },
        itemBuilder: (context, element) {
          return ListTile(
              onTap: () {
                Navigator.pushNamed(context, '/matkul');
              },
              title: Text(element.name));
        },
      ),
    );
  }
}

// List _elements = [
//   {'name': 'John', 'hari': 'Team A'},
//   {'name': 'Will', 'hari': 'Team B'},
//   {'name': 'Beth', 'hari': 'Team A'},
//   {'name': 'Beth', 'hari': 'Team A'},
//   {'name': 'Miranda', 'hari': 'Team B'},
//   {'name': 'Miranda', 'hari': 'Team B'},
//   {'name': 'Miranda', 'hari': 'Team B'},
//   {'name': 'Mike', 'hari': 'Team C'},
//   {'name': 'Danny', 'hari': 'Team C'},
//   {'name': 'Danny', 'hari': 'Team C'},
//   {'name': 'Danny', 'hari': 'Team C'},
// ];
