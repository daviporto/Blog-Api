Esta api serve ao seguinte [app](https://gitlab.com/b3176/app)


1. Abra a pasta back_end no terminal e execute o comando "composer install".
2. Renomeio o arquivo .env.exemple para .env e faça as configurações para a conexão com o banco de dados.
3. Execute o comando "php artisan migrate".
4. Execute o comando "php artisan serve".
5. Para integrar com o app, caso o servidor rode na propria máquina, é necessário configurar o Ngrok, siga os passos deste [tutorial](https://wallacemaxters.com.br/blog/2021/03/07/utilizando-ngrok-com-laravel).