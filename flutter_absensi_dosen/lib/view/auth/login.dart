import 'package:flutter/material.dart';
import 'package:flutter_absensi_dosen/view/dashboard/index.dart';
import 'package:flutter_login/flutter_login.dart';
import 'package:form_field_validator/form_field_validator.dart';

class ViewLogin extends StatefulWidget {
  @override
  _ViewLoginState createState() => _ViewLoginState();
}

class _ViewLoginState extends State<ViewLogin> {
  Duration get loginTime => Duration(milliseconds: 2250);

  Future<String> _authUser(LoginData data) {
    print('Name: ${data.name}, Password: ${data.password}');
    return Future.delayed(loginTime).then((_) {
      return null;
    });
  }

  @override
  Widget build(BuildContext context) {
    return FlutterLogin(
      title: 'Login',
      onLogin: (loginData) => _authUser(loginData),
      onSignup: null,
      onRecoverPassword: null,
      titleTag: 'Login Aplikasi Dosen',
      emailValidator: EmailValidator(errorText: 'Masukan email yang benar'),
      hideForgotPasswordButton: true,
      hideSignUpButton: true,
      onSubmitAnimationCompleted: () {
        Navigator.pushReplacement(
          context,
          MaterialPageRoute(builder: (context) => ViewDashboard()),
        );
      },
    );
  }
}
