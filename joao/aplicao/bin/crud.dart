import 'dart:io';
import 'package:crud/funcoes.dart';
import 'package:crud/model/funcionario_model.dart';
import 'package:crud/model/setor_model.dart';

void main() async {
  List<FuncionarioModel> funcionarios = [];
  List<SetorModel> setor = [];

  funcionarios = await getFuncionarios();
  setor = await getSetor();

  String? opc;
  do {
    printW("""
    ...::: MENU :::... "
    1. Todos dos funcionario."
    2. Todos dos setor.
    3. Cadastro de funcionario.
    4. Cadastro de setor (Implementar).
    5. Atualizar de funcionario	(Implementar).
    6. Relatorio (Implementar).
    7. Sair.
  """);

    opc = stdin.readLineSync();
    switch (opc) {
      case '1':
        todosOsFuncionarios(funcionarios: funcionarios);
        break;
      case '2':
        todosOsSetores(setor: setor);
        break;
      case '3':
        await cadastrarFuncionario();
        funcionarios = await getFuncionarios();
        break;
      case '4':
        cadastrarSetor();
        setor = await getSetor();
        break;
      case '5':
        await atualizarFuncionario();
        break;
      case '6':
        relatorio();
        break;
      case '7':
        printE("Saindo");
        break;
      default:
        printE("Opção Invalida");
    }
  } while (opc != '7');
}
