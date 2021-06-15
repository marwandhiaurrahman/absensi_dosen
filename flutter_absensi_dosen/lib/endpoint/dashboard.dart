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
    @required this.jadwalaktif,
  });

  User user;
  List<Jadwal> jadwaltodays;
  List<Jadwalaktif> jadwalaktif;

  factory Dasboard.fromJson(Map<String, dynamic> json) => Dasboard(
        user: User.fromJson(json["user"]),
        jadwaltodays: List<Jadwal>.from(
            json["jadwaltodays"].map((x) => Jadwal.fromJson(x))),
        jadwalaktif: List<Jadwalaktif>.from(
            json["jadwalaktif"].map((x) => Jadwalaktif.fromJson(x))),
      );

  Map<String, dynamic> toJson() => {
        "user": user.toJson(),
        "jadwaltodays": List<dynamic>.from(jadwaltodays.map((x) => x.toJson())),
        "jadwalaktif": List<dynamic>.from(jadwalaktif.map((x) => x.toJson())),
      };

//   factory Dasboard.fromJson(Map<String, dynamic> json) => Dasboard(
//         user: User.fromJson(json["user"]),
//         jadwaltodays: List<Jadwal>.from(
//             json["jadwaltodays"].map((x) => Jadwal.fromJson(x))),
//       );

//   Map<String, dynamic> toJson() => {
//         "user": user.toJson(),
//         "jadwaltodays": List<dynamic>.from(jadwaltodays.map((x) => x.toJson())),
//       };
}

class Jadwalaktif {
  Jadwalaktif({
    @required this.id,
    @required this.kode,
    @required this.hari,
    @required this.jam,
    @required this.matkulId,
    @required this.ruanganId,
    @required this.kelasId,
    @required this.createdAt,
    @required this.updatedAt,
    @required this.absensi,
  });

  int id;
  String kode;
  String hari;
  String jam;
  int matkulId;
  int ruanganId;
  int kelasId;
  DateTime createdAt;
  DateTime updatedAt;
  List<Absensi> absensi;

  factory Jadwalaktif.fromJson(Map<String, dynamic> json) => Jadwalaktif(
        id: json["id"],
        kode: json["kode"],
        hari: json["hari"],
        jam: json["jam"],
        matkulId: json["matkul_id"],
        ruanganId: json["ruangan_id"],
        kelasId: json["kelas_id"],
        createdAt: DateTime.parse(json["created_at"]),
        updatedAt: DateTime.parse(json["updated_at"]),
        absensi:
            List<Absensi>.from(json["absensi"].map((x) => Absensi.fromJson(x))),
      );

  Map<String, dynamic> toJson() => {
        "id": id,
        "kode": kode,
        "hari": hari,
        "jam": jam,
        "matkul_id": matkulId,
        "ruangan_id": ruanganId,
        "kelas_id": kelasId,
        "created_at": createdAt.toIso8601String(),
        "updated_at": updatedAt.toIso8601String(),
        "absensi": List<dynamic>.from(absensi.map((x) => x.toJson())),
      };
}

class Absensi {
  Absensi({
    @required this.id,
    @required this.pertemuan,
    @required this.tanggal,
    @required this.metode,
    @required this.pembahasan,
    @required this.masuk,
    @required this.keluar,
    @required this.jarak,
    @required this.jadwalId,
    @required this.createdAt,
    @required this.updatedAt,
  });

  int id;
  String pertemuan;
  DateTime tanggal;
  String metode;
  String pembahasan;
  String masuk;
  String keluar;
  double jarak;
  int jadwalId;
  DateTime createdAt;
  DateTime updatedAt;

  factory Absensi.fromJson(Map<String, dynamic> json) => Absensi(
        id: json["id"],
        pertemuan: json["pertemuan"],
        tanggal: DateTime.parse(json["tanggal"]),
        metode: json["metode"],
        pembahasan: json["pembahasan"],
        masuk: json["masuk"],
        keluar: json["keluar"] == null ? null : json["keluar"],
        jarak: json["jarak"].toDouble(),
        jadwalId: json["jadwal_id"],
        createdAt: DateTime.parse(json["created_at"]),
        updatedAt: DateTime.parse(json["updated_at"]),
      );

  Map<String, dynamic> toJson() => {
        "id": id,
        "pertemuan": pertemuan,
        "tanggal":
            "${tanggal.year.toString().padLeft(4, '0')}-${tanggal.month.toString().padLeft(2, '0')}-${tanggal.day.toString().padLeft(2, '0')}",
        "metode": metode,
        "pembahasan": pembahasan,
        "masuk": masuk,
        "keluar": keluar == null ? null : keluar,
        "jarak": jarak,
        "jadwal_id": jadwalId,
        "created_at": createdAt.toIso8601String(),
        "updated_at": updatedAt.toIso8601String(),
      };
}
