import 'dart:convert';
import 'dart:io';
import 'package:crud/model/funcionario_model.dart';
import 'package:http/http.dart' as http;
import 'model/setor_model.dart';

String host = "http://localhost:7777/api/index.php";

todosOsFuncionarios({required List<FuncionarioModel> funcionarios}) {
  limparPrint();
  for (int i = 0; i < funcionarios.length; i++) {
    printO("${funcionarios[i].matricula} - ${funcionarios[i].nome} - ${funcionarios[i].setor?.setor}");
  }
}

todosOsSetores({required List<SetorModel> setor}) {
  limparPrint();
  for (SetorModel item in setor) {
    printO("${item.id} - ${item.setor}");
  }
}

cadastrarFuncionario() async {
  try {
    limparPrint();
    FuncionarioModel funcionarios = FuncionarioModel();
    funcionarios.setor = SetorModel();
    printO("...::: Cadastrar funcionario :::...");
    printO("Nome do novo funcionario:");
    funcionarios.nome = stdin.readLineSync()!;
    printO("Codigo do setor");
    funcionarios.setor?.id = int.parse(stdin.readLineSync()!);

    var response = await http.post(
      Uri.parse(host),
      body: {
        'acao': 'cadastro_funcionario',
        'nome': '${funcionarios.nome}',
        'id_setor': '${funcionarios.setor?.id}',
      },
    );

    if (response.statusCode == 200) {
      printW("Funcionario Cadastrado com sucesso, matricula: ${response.body}");
    } else {
      printW("Erro ao fazer o cadastro:\n ${response.body}");
    }
  } catch (e) {
    printE("Erro CadastrarFuncionario: $e");
  }
}

cadastrarSetor() async {
  limparPrint();
  printE('Implementar função');
}

atualizarFuncionario() async {
  limparPrint();
  printE('Implementar função');
}

relatorio() {
  limparPrint();
  printE('Implementar relatorio');
}

Future<List<FuncionarioModel>> getFuncionarios() async {
  try {
    final res = await http.get(Uri.parse("$host?acao=funcionario"));
    List retono = jsonDecode(res.body);

    return retono.map((item) => FuncionarioModel.fromJson(item)).toList();
  } catch (e) {
    printE("Erro ao carregar funcionarios: $e");
    return [];
  }
}

Future<List<SetorModel>> getSetor() async {
  printE('Implementar getSetor');
  return [];
}

void printW(text) {
  print('\x1B[33m$text\x1B[0m');
}

void printE(text) {
  print('\x1B[31m$text\x1B[0m');
}

void printO(text) {
  print('\x1b[32m$text\x1B[0m');
}

void limparPrint() {
  print("\x1B[2J\x1B[0;0H");
}
