import 'package:flutter/material.dart';
import 'package:flutter_login/flutter_login.dart';
import 'package:form_field_validator/form_field_validator.dart';

class LoginView extends StatefulWidget {
  @override
  _LoginViewState createState() => _LoginViewState();
}

class _LoginViewState extends State<LoginView> {
  Duration get loginTime => Duration(milliseconds: 2250);

  Future<String> _authUser(LoginData data) {
    print('Login Info Name: ${data.name}, Password: ${data.password}');
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
        Navigator.pushReplacementNamed(context, '/dashboard');
      },
    );
  }
}
