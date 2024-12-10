container_php = 'php_access'
container_db = None

waiting_db_connection = False

containers = [
    container_php,
    container_db
]

container_work_dir = '/www'

docker_compose_files_list = [
    'docker-compose.yaml'
]

commands = {
    'composer install': 'composer install',
    'composer run phpunit': 'XDEBUG_MODE=coverage composer run phpunit',
    'composer run phpstan': 'composer run phpstan',
    'composer run psalm': 'composer run psalm',
    'composer run phpmd': 'composer run phpmd',
}
