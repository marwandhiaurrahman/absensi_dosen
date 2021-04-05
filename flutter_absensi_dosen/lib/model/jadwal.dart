// To parse this JSON data, do
//
//     final jadwal = jadwalFromJson(jsonString);

import 'package:meta/meta.dart';
import 'dart:convert';

List<Jadwal> jadwalFromJson(String str) =>
    List<Jadwal>.from(json.decode(str).map((x) => Jadwal.fromJson(x)));

String jadwalToJson(List<Jadwal> data) =>
    json.encode(List<dynamic>.from(data.map((x) => x.toJson())));

class Jadwal {
  Jadwal({
    @required this.id,
    @required this.kode,
    @required this.hari,
    @required this.jam,
    @required this.matkulId,
    @required this.ruanganId,
    @required this.kelasId,
    @required this.createdAt,
    @required this.updatedAt,
    @required this.matkul,
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
  Matkul matkul;

  factory Jadwal.fromJson(Map<String, dynamic> json) => Jadwal(
        id: json["id"],
        kode: json["kode"],
        hari: json["hari"],
        jam: json["jam"],
        matkulId: json["matkul_id"],
        ruanganId: json["ruangan_id"],
        kelasId: json["kelas_id"],
        createdAt: DateTime.parse(json["created_at"]),
        updatedAt: DateTime.parse(json["updated_at"]),
        matkul: Matkul.fromJson(json["matkul"]),
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
        "matkul": matkul.toJson(),
      };
}

class Matkul {
  Matkul({
    @required this.id,
    @required this.name,
    @required this.kode,
    @required this.userId,
    @required this.createdAt,
    @required this.updatedAt,
    @required this.dosen,
  });

  int id;
  String name;
  String kode;
  int userId;
  DateTime createdAt;
  DateTime updatedAt;
  Dosen dosen;

  factory Matkul.fromJson(Map<String, dynamic> json) => Matkul(
        id: json["id"],
        name: json["name"],
        kode: json["kode"],
        userId: json["user_id"],
        createdAt: DateTime.parse(json["created_at"]),
        updatedAt: DateTime.parse(json["updated_at"]),
        dosen: Dosen.fromJson(json["dosen"]),
      );

  Map<String, dynamic> toJson() => {
        "id": id,
        "name": name,
        "kode": kode,
        "user_id": userId,
        "created_at": createdAt.toIso8601String(),
        "updated_at": updatedAt.toIso8601String(),
        "dosen": dosen.toJson(),
      };
}

class Dosen {
  Dosen({
    @required this.id,
    @required this.name,
    @required this.email,
    @required this.emailVerifiedAt,
    @required this.foto,
    @required this.createdAt,
    @required this.updatedAt,
  });

  int id;
  String name;
  String email;
  dynamic emailVerifiedAt;
  dynamic foto;
  DateTime createdAt;
  DateTime updatedAt;

  factory Dosen.fromJson(Map<String, dynamic> json) => Dosen(
        id: json["id"],
        name: json["name"],
        email: json["email"],
        emailVerifiedAt: json["email_verified_at"],
        foto: json["foto"],
        createdAt: DateTime.parse(json["created_at"]),
        updatedAt: DateTime.parse(json["updated_at"]),
      );

  Map<String, dynamic> toJson() => {
        "id": id,
        "name": name,
        "email": email,
        "email_verified_at": emailVerifiedAt,
        "foto": foto,
        "created_at": createdAt.toIso8601String(),
        "updated_at": updatedAt.toIso8601String(),
      };
}
