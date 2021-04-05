import 'package:flutter_absensi_dosen/model/dosen.dart';
import 'package:meta/meta.dart';

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
