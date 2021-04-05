// To parse this JSON data, do
//
//     final dasboard = dasboardFromJson(jsonString);

import 'package:flutter_absensi_dosen/model/jadwal.dart';
import 'package:flutter_absensi_dosen/model/user.dart';
import 'package:meta/meta.dart';
import 'dart:convert';

Dasboard dasboardFromJson(String str) =>
    Dasboard.fromJson(json.decode(str)['data']);

String dasboardToJson(Dasboard data) => json.encode(data.toJson());

class Dasboard {
  Dasboard({
    @required this.user,
    @required this.jadwaltodays,
  });

  User user;
  List<Jadwal> jadwaltodays;

  factory Dasboard.fromJson(Map<String, dynamic> json) => Dasboard(
        user: User.fromJson(json["user"]),
        jadwaltodays: List<Jadwal>.from(
            json["jadwaltodays"].map((x) => Jadwal.fromJson(x))),
      );

  Map<String, dynamic> toJson() => {
        "user": user.toJson(),
        "jadwaltodays": List<dynamic>.from(jadwaltodays.map((x) => x.toJson())),
      };
}
