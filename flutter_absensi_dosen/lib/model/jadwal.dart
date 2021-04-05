import 'package:meta/meta.dart';
import 'matkul.dart';

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
