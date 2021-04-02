import 'package:flutter/material.dart';
import 'package:flutter_absensi_dosen/main.dart';
import 'package:flutter_absensi_dosen/view/auth/login.dart';
import 'package:flutter_absensi_dosen/view/dashboard/index.dart';

var myRoutes = <String, WidgetBuilder>{
  '/': (context) => MyApp(),
  '/dashboard': (context) => DashboardView(),
  '/login': (context) => LoginView(),
  '/jadwal': (context) => LoginView(),
};
