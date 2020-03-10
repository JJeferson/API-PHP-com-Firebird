<?php

/*
https://www.codigofonte.com.br/codigos/conexao-com-firebird-usando-php

c:\Xammp\php\php.ini
localizar a linha  ;extension=php_interbase.dll
retira-se o ; e salva.
Reiniciar no console do xammp os serviços todos.

O arquivo GDB, ou FDB não pode estar na pasta httpDocs, ou na pasta do apache.



$conexao = ibase_connect("127.0.0.1:c:/tuto/tutorial.gdb","SYSDBA","masterkey");
$sql = "insert into cadastro (codigo,descricao) values ("001","interbase")";
$resultado = ibase_query($conexao, $sql);
ibase_close($conexao);

Read more: http://www.linhadecodigo.com.br/artigo/119/manipulacao-de-dados-via-php-firebird.aspx#ixzz6811RehUn





*/


$conexao = ibase_connect("192.168.0.104:C:\Banco_Firebird\Banco_DADOS.GDB","SYSDBA","masterkey","utf8");

 
//instrução
$sql = "select item_id,descricao  from produtos  ";
//Executa
$resultado = ibase_query($conexao, $sql);

//Cria o Array e coloca  a pesquisa dentro dele.
$dados = array();
while ( $Linha_Banco = ibase_fetch_row( $resultado ) )
{

    /*
                     //Comando Original
                     $dados = array();
                     while ( $Linha_Banco = ibase_fetch_row( $resultado ) ) 
                     {
                     $dados[] = $Linha_Banco;
                     }
                 Precisei mexer no comando original para ser capaz de gerar o Json corretamente.
    */

   $dados[] = ['item_id' => utf8_encode($Linha_Banco['0']),'descricao' => utf8_encode($Linha_Banco['1'])];

}
 


//converte pra Json
echo json_encode($dados);

 
//Libera a memoria usada
ibase_free_result($dados);
//fecha conexão com o Firebird
ibase_close($conexao);

?>