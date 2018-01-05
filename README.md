- **link**: https://mvc-testing-br.herokuapp.com/

# Estrutura de pastas do projeto  

- **app**: Pasta que contem toda as regras de negócio, Controllers, Model e Views do sistema.  
**app/Application.php**  
**app/Services.php**  

- **app/Config**: Pasta que contem os arquivos com as configurações do sistema.  
**app/Config/Connect.php**  
**app/Config/Env.php**  

- **app/Controller**: Pasta que contem todos os controllers.  
**app/Controller/IndexController.php**: Arquivo de exemplo  
**app/Controller/ProdutoController.php**: Arquivo de exemplo  

- **app/CRUD**: Pasta que contem as classes de Select, Insert e Delete para administrar o bando de dados da aplicação.  
**app/CRUD/Delete.php**  
**app/CRUD/Insert.php**  
**app/CRUD/Select.php**  

- **app/Models**: Pasta que contem todos os models, e toda a regra de negócio.  
**app/Models/Produto.php**: Arquivo de exemplo  

- **app/Routes**: Pasta que contem os arquivos com todas as rotas do sistema.  
**app/Routes/RouteGet.php**  
**app/Routes/RoutePost.php**  

- **app/Views**: Pasta que contem todas as views do sistema.  
**app/Views/detalhe.html**: Arquivo de exemplo  
**app/Views/listagem.phtml**: Arquivo de exemplo  

- **app/Views/includes**: Pasta onde ficaram os arquivos que serão reutilizados e incluidos nas views.  
**app/Views/includes/footer.phtml**  
**app/Views/includes/header.phtml**  

- **public**: Pasta onde ficaram os arquivos que o usuario consiguira acessar pelo navegador  