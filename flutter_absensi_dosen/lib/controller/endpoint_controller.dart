// To parse this JSON data, do
//
//     final dashboard = dashboardFromJson(jsonString);

import 'package:flutter_absensi_dosen/model/jadwal.dart';
import 'package:flutter_absensi_dosen/model/user.dart';
import 'package:meta/meta.dart';
import 'dart:convert';

Dashboard dashboardFromJson(String str) =>
    Dashboard.fromJson(json.decode(str)['data']);

String dashboardToJson(Dashboard data) => json.encode(data.toJson());

class Dashboard {
  Dashboard({
    @required this.user,
    @required this.jadwal,
  });

  User user;
  List<Jadwal> jadwal;

  factory Dashboard.fromJson(Map<String, dynamic> json) => Dashboard(
        user: User.fromJson(json["user"]),
        jadwal:
            List<Jadwal>.from(json["jadwal"].map((x) => Jadwal.fromJson(x))),
      );

  Map<String, dynamic> toJson() => {
        "user": user.toJson(),
        "jadwal": List<dynamic>.from(jadwal.map((x) => x.toJson())),
      };
}
