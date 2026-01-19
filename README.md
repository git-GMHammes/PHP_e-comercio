# Sistema de Comércio Eletrônico - CodeIgniter 4.6

Este documento apresenta uma análise completa da estrutura e arquitetura do projeto **ci46comercio**, um sistema de e-commerce desenvolvido em CodeIgniter 4.6.

## 📋 Visão Geral

O projeto é um sistema de comércio eletrônico moderno que utiliza o framework CodeIgniter 4.6, implementando uma arquitetura MVC bem estruturada com separação clara entre funcionalidades administrativas e do usuário final.

## 🏗️ Arquitetura do Sistema

### Estrutura Principal
```
ci46comercio/
├── docker/                    # Configurações de containerização
│   ├── nginx/                # Servidor web
│   └── php/                  # Runtime PHP
├── src/                      # Código fonte principal
│   ├── app/                  # Aplicação CodeIgniter
│   └── public/               # Arquivos públicos
└── docker-compose.yml        # Orquestração de containers
```

### Padrão MVC Implementado
O projeto segue rigorosamente o padrão Model-View-Controller:

- **Controllers**: Gerenciam a lógica de requisições
- **Models**: Manipulam dados e regras de negócio
- **Views**: Renderizam a interface do usuário
- **Entities**: Representam objetos de domínio

## 🛠️ Tecnologias e Ferramentas

- **Framework**: CodeIgniter 4.6
- **PHP**: Versão compatível com CI4
- **Servidor Web**: Nginx (via Docker)
- **Containerização**: Docker + Docker Compose
- **Sistema de Autenticação**: Ion Auth (integrado)

## 📁 Estrutura Detalhada

### Controllers
```
Controllers/
├── Admin/                    # Área administrativa
│   ├── Dashboard.php         # Painel principal
│   ├── Categories.php        # Gestão de categorias
│   ├── Attributes.php        # Atributos de produtos
│   ├── AttributeOptions.php  # Opções de atributos
│   ├── Brands.php           # Marcas
│   └── Products.php         # Gestão de produtos
├── BaseController.php        # Controlador base
├── Home.php                 # Página inicial
└── Products.php             # Produtos (front-end)
```

### Models
```
Models/
├── AttributeModel.php
├── AttributeOptionModel.php
├── BrandModel.php
├── CategoryModel.php
├── ProductModel.php
├── ProductAttributeValueModel.php
├── ProductImageModel.php
└── ProductInventoryModel.php
```

### Entities
```
Entities/
├── Attribute.php
├── AttributeOption.php
├── Brand.php
├── Category.php
├── Product.php
├── ProductAttributeValue.php
├── ProductImage.php
└── ProductInventory.php
```

## 🔐 Sistema de Segurança

### Autenticação e Autorização
- **Ion Auth**: Sistema completo de autenticação integrado
- **Filtros de Segurança**: `AdminAuthFilter` para proteção da área administrativa
- **Níveis de Acesso**: Configurados para `admin` e `operator`

### Estrutura de Autenticação
```
Views/auth/
├── login.php
├── forgot_password.php
├── reset_password.php
├── create_user.php
├── edit_user.php
└── email/                   # Templates de email
```

## 🛣️ Sistema de Rotas

### Análise das Rotas Configuradas

#### Rotas Públicas
```php
$routes->get('/', 'Home::index');           # Página inicial
$routes->get('products', 'Products::index'); # Listagem de produtos
```

#### Área Administrativa Protegida
```php
$routes->group('admin', ['filter' => 'admin-auth:admin,operator'], function ($routes) {
    // Dashboard
    $routes->get('dashboard', 'Admin\Dashboard::index');
    
    // Gestão de Categorias
    $routes->get('categories', 'Admin\Categories::index');
    $routes->post('categories', 'Admin\Categories::store');
    $routes->put('categories/(:num)', 'Admin\Categories::update/$1');
    $routes->delete('categories/(:num)', 'Admin\Categories::destroy/$1');
    
    // Gestão de Atributos
    $routes->get('attributes', 'Admin\Attributes::index');
    // ... operações CRUD completas
    
    // Gestão de Produtos
    $routes->get('products', 'Admin\Products::index');
    $routes->get('products/create', 'Admin\Products::create');
    $routes->get('products/(:num)/edit', 'Admin\Products::edit/$1');
    $routes->get('products/(:num)/images', 'Admin\Products::images/$1');
    // ... operações CRUD e gestão de imagens
});
```

## 🚀 Funcionalidades Implementadas

### Gestão de Produtos
- ✅ CRUD completo de produtos
- ✅ Sistema de categorização
- ✅ Gestão de atributos e opções
- ✅ Upload e gestão de imagens
- ✅ Controle de inventário
- ✅ Sistema de marcas
- ✅ Soft delete com possibilidade de restauração

### Funcionalidades Administrativas
- ✅ Dashboard administrativo
- ✅ Gestão de usuários e grupos
- ✅ Sistema de permissões por nível
- ✅ Interface de criação/edição separada da listagem

### Sistema de Imagens
- ✅ Upload de múltiplas imagens por produto
- ✅ Interface dedicada para gestão de imagens
- ✅ Exclusão individual de imagens

## 📊 Modelagem de Dados

### Entidades Principais
1. **Product**: Produto principal do e-commerce
2. **Category**: Categorização hierárquica
3. **Brand**: Marcas dos produtos
4. **Attribute**: Atributos personalizáveis
5. **AttributeOption**: Valores possíveis para atributos
6. **ProductImage**: Imagens associadas aos produtos
7. **ProductInventory**: Controle de estoque
8. **ProductAttributeValue**: Valores específicos por produto

### Relacionamentos Identificados
```
Product 1:N ProductImage
Product 1:N ProductAttributeValue
Product N:1 Category
Product N:1 Brand
Attribute 1:N AttributeOption
ProductAttributeValue N:1 Attribute
ProductAttributeValue N:1 AttributeOption
```

## 🐳 Containerização

### Docker Setup
```
docker/
├── nginx/
│   └── default.conf         # Configuração do Nginx
└── php/
    └── Dockerfile          # Build do container PHP
```

### Vantagens da Containerização
- **Isolamento**: Ambiente consistente entre desenvolvimento e produção
- **Portabilidade**: Facilita deploy em diferentes ambientes
- **Escalabilidade**: Preparado para orquestração avançada

## 🔧 Configurações e Helpers

### Helpers Customizados
- `general_helper.php`: Funções utilitárias gerais
- `myprint_helper.php`: Funções de debug e impressão

### Filtros de Segurança
- `AdminAuthFilter.php`: Controla acesso à área administrativa

## 📈 Pontos Fortes do Projeto

1. **Arquitetura Limpa**: Separação clara de responsabilidades
2. **Segurança Robusta**: Sistema de autenticação e autorização bem implementado
3. **Escalabilidade**: Estrutura preparada para crescimento
4. **Manutenibilidade**: Código organizado e bem estruturado
5. **Modernidade**: Uso de containers e práticas atuais

## 🎯 Recomendações de Evolução

### Melhorias Técnicas
1. **API REST**: Implementar endpoints para integração
2. **Cache**: Configurar sistema de cache para performance
3. **Testes**: Implementar testes unitários e de integração
4. **Documentação**: API documentation com Swagger
5. **Logs**: Sistema de auditoria e logs detalhados

### Funcionalidades Futuras
1. **Carrinho de Compras**: Sistema completo de e-commerce
2. **Pagamentos**: Integração com gateways de pagamento
3. **Relatórios**: Dashboard com métricas e relatórios
4. **SEO**: Otimizações para mecanismos de busca
5. **Multi-idioma**: Suporte a internacionalização

## 💡 Conclusão

O projeto **ci46comercio** demonstra uma implementação sólida e bem estruturada de um sistema de e-commerce usando CodeIgniter 4.6. A arquitetura modular, sistema de segurança robusto e uso de containerização mostram boas práticas de desenvolvimento moderno. O projeto está bem preparado para evoluções futuras e mantém alta qualidade de código e organização.

---

*Análise realizada em: Janeiro 2026*
*Framework: CodeIgniter 4.6*
*Ambiente: Docker + Nginx + PHP*

---

# Instalação CodeIgniter 4.6

## Estrutura do Projeto

```
C:\laragon\www\ci46comercio\
├── doc/
├── docker/
├── src/                    ← CodeIgniter 4.6 será instalado aqui
├── docker-compose.yml
└── README.md
```

---

## Passo 1: Acessar o Container PHP

Abra o **PowerShell** e execute:

```bash
cd C:\laragon\www\ci46comercio

docker exec -it ci46comercio_php sh
```

---

## Passo 2: Instalar CodeIgniter 4.6

Dentro do container, execute:

```bash
cd /var/www/html

composer create-project codeigniter4/appstarter . "^4.6"
```

---

## Passo 3: Verificar Instalação

Acesse no navegador:

```
http://localhost:56100
```

Deve aparecer a página de boas-vindas do CodeIgniter 4.

---

## Troubleshooting

### Erro: "Could not find package"

```bash
composer clear-cache
composer create-project codeigniter4/appstarter . "^4.6"
```

### Erro de permissão

```bash
chmod -R 777 /var/www/html/writable
```

---

## Portas Utilizadas

- **Aplicação**: http://localhost:56100
- **MySQL**: localhost:56101
- **Adminer**: http://localhost:56102
- **Redis**: localhost:56103

---

## Credenciais do Banco

- **Host**: mysql
- **Porta**: 3306
- **Database**: ci46comercio_db
- **Usuário**: ci46comercio_user
- **Senha**: ci46comercio_P@ssw0rd_2024

# 🚀 MIGRAÇÃO CODEIGNITER 4.1 → 4.6 COM PHP 8.3

## 📁 ESTRUTURA DE PASTAS

Coloque os arquivos nas seguintes localizações:

```
C:\laragon\www\ci46comercio\
├── docker-compose.yml          ← SUBSTITUA este arquivo
├── docker\
│   ├── php\
│   │   └── Dockerfile          ← SUBSTITUA este arquivo
│   └── nginx\
│       └── default.conf        ← SUBSTITUA este arquivo
└── src\                        ← Aqui vai seu CodeIgniter 4.6
```

---

## 🔧 MUDANÇAS REALIZADAS

### 1️⃣ **Dockerfile** (docker/php/Dockerfile)

**O QUE MUDOU:**

- ❌ `FROM php:7.4-fpm-alpine`
- ✅ `FROM php:8.3-fpm-alpine`

**EXTENSÕES ADICIONADAS:**

- ✅ `curl` - Para requisições HTTP (necessário para CI 4.6)
- ✅ `xml` e `simplexml` - Para processamento XML
- ✅ `gd` - Para manipulação de imagens
- ✅ `opcache` - Para cache de código PHP (performance)

**CONFIGURAÇÕES PHP ADICIONADAS:**

- `memory_limit = 256M`
- `upload_max_filesize = 50M`
- `post_max_size = 50M`
- `max_execution_time = 300`
- OPcache configurado para melhor performance

---

### 2️⃣ **docker-compose.yml**

**O QUE MUDOU:**

- ❌ Removido: `APP_NAME: "Laravel API"` (era de outro projeto)
- ❌ Removido: `APP_ENV`, `APP_DEBUG`, `APP_URL` (variáveis do Laravel)

**VARIÁVEIS ADICIONADAS PARA CODEIGNITER 4.6:**

```yaml
DB_CONNECTION: MySQLi # Driver do CI4
CI_ENVIRONMENT: development # Ambiente do CI4
APP_NAME: "CI46 Comercio"
APP_BASE_URL: http://localhost:56100
REDIS_HOST: redis
REDIS_PORT: 6379
```

---

### 3️⃣ **default.conf** (docker/nginx/default.conf)

**O QUE MUDOU:**

- ✅ **NADA!** Este arquivo já estava perfeito para CodeIgniter 4.6
- Mantido apenas para você ter todos os arquivos em um lugar

---

# Checklist de Migração - CodeIgniter 4.1 → 4.6

## ✅ Preparação

- [x] Docker configurado (PHP 8.3, MySQL 8.0, Redis, Nginx)
- [x] Banco de dados criado com 19 tabelas
- [x] CodeIgniter 4.6 instalado via Composer

---

## 📁 Arquivos para COPIAR (sem alterações)

### Helpers

- [ ] `app/Helpers/general_helper.php`

### Models (8 arquivos)

- [ ] `app/Models/AttributeModel.php`
- [ ] `app/Models/AttributeOptionModel.php`
- [ ] `app/Models/BrandModel.php`
- [ ] `app/Models/CategoryModel.php`
- [ ] `app/Models/ProductModel.php`
- [ ] `app/Models/ProductAttributeValueModel.php`
- [ ] `app/Models/ProductImageModel.php`
- [ ] `app/Models/ProductInventoryModel.php`

### Entities (8 arquivos)

- [ ] `app/Entities/Attribute.php`
- [ ] `app/Entities/AttributeOption.php`
- [ ] `app/Entities/Brand.php`
- [ ] `app/Entities/Category.php`
- [ ] `app/Entities/Product.php`
- [ ] `app/Entities/ProductAttributeValue.php`
- [ ] `app/Entities/ProductImage.php`
- [ ] `app/Entities/ProductInventory.php`

### Controllers (9 arquivos)

- [ ] `app/Controllers/Home.php`
- [ ] `app/Controllers/Products.php`
- [ ] `app/Controllers/Admin/Dashboard.php`
- [ ] `app/Controllers/Admin/Categories.php`
- [ ] `app/Controllers/Admin/Brands.php`
- [ ] `app/Controllers/Admin/Attributes.php`
- [ ] `app/Controllers/Admin/AttributeOptions.php`
- [ ] `app/Controllers/Admin/Products.php`
- [ ] ~~`app/Controllers/Auth.php`~~ (DELETAR - IonAuth descontinuado)

### Views

- [ ] Copiar TODAS as views de `app/Views/` (exceto auth se houver)

---

## ✏️ Arquivos para CRIAR/MODIFICAR

### 1. BaseController.php

**Arquivo:** `app/Controllers/BaseController.php`

**Modificar:**

```php
protected $helpers = ['form', 'url', 'general'];

protected $currentUser = null;
protected $data = [];
protected $session = null;
protected $db;

public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
{
    parent::initController($request, $response, $logger);

    $this->session = \Config\Services::session();
    $this->data['session'] = $this->session;

    if (service('auth')->loggedIn()) {
        $this->currentUser = service('auth')->user();
    }

    $this->data['currentUser'] = $this->currentUser;
    $this->data['currentTheme'] = 'indomarket';

    $this->db = \Config\Database::connect();
}
```

---

### 2. AdminAuthFilter.php

**Arquivo:** `app/Filters/AdminAuthFilter.php` (CRIAR)

```php
<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AdminAuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (!service('auth')->loggedIn()) {
            return redirect()->to('/login');
        }

        $user = service('auth')->user();

        if ($arguments !== null) {
            $hasAccess = false;
            foreach ($arguments as $group) {
                if ($user->inGroup($group)) {
                    $hasAccess = true;
                    break;
                }
            }

            if (!$hasAccess) {
                session()->setFlashdata('error', "You don't have permission to access this page.");
                return redirect()->to('/');
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}
```

---

### 3. App.php

**Arquivo:** `app/Config/App.php`

**Modificar 3 linhas:**

```php
public string $baseURL = 'http://localhost:56100/';
public string $indexPage = '';
public string $appTimezone = 'America/Sao_Paulo';
```

---

### 4. Cache.php

**Arquivo:** `app/Config/Cache.php`

**Modificar 1 linha:**

```php
public array $redis = [
    'host'     => 'redis',  // ← Mudar de '127.0.0.1' para 'redis'
    'password' => null,
    'port'     => 6379,
    'timeout'  => 0,
    'database' => 0,
];
```

---

### 5. Database.php

**Arquivo:** `app/Config/Database.php`

**Modificar 4 linhas:**

```php
public array $default = [
    // ...
    'hostname' => 'mysql',
    'username' => 'ci46comercio_user',
    'password' => 'ci46comercio_P@ssw0rd_2024',
    'database' => 'ci46comercio_db',
    // ...
];
```

---

### 6. Filters.php

**Arquivo:** `app/Config/Filters.php`

**Adicionar no array `$aliases`:**

```php
public array $aliases = [
    'csrf'          => CSRF::class,
    'toolbar'       => DebugToolbar::class,
    'honeypot'      => Honeypot::class,
    'invalidchars'  => InvalidChars::class,
    'secureheaders' => SecureHeaders::class,
    'cors'          => Cors::class,
    'forcehttps'    => ForceHTTPS::class,
    'pagecache'     => PageCache::class,
    'performance'   => PerformanceMetrics::class,
    'admin-auth'    => \App\Filters\AdminAuthFilter::class,  // ← ADICIONAR
];
```

---

### 7. Routes.php

**Arquivo:** `app/Config/Routes.php`

**Substituir conteúdo por:**

```php
<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('products', 'Products::index');

$routes->group('admin', ['filter' => 'admin-auth:admin,operator'], function ($routes) {
    $routes->get('dashboard', 'Admin\Dashboard::index');

    $routes->get('categories', 'Admin\Categories::index');
    $routes->get('categories/(:num)', 'Admin\Categories::index/$1');
    $routes->post('categories', 'Admin\Categories::store');
    $routes->put('categories/(:num)', 'Admin\Categories::update/$1');
    $routes->delete('categories/(:num)', 'Admin\Categories::destroy/$1');

    $routes->get('attributes', 'Admin\Attributes::index');
    $routes->get('attributes/(:num)', 'Admin\Attributes::index/$1');
    $routes->post('attributes', 'Admin\Attributes::store');
    $routes->put('attributes/(:num)', 'Admin\Attributes::update/$1');
    $routes->delete('attributes/(:num)', 'Admin\Attributes::destroy/$1');

    $routes->get('attribute-options', 'Admin\AttributeOptions::index');
    $routes->get('attribute-options/(:num)', 'Admin\AttributeOptions::index/$1');
    $routes->get('attribute-options/(:num)/(:num)', 'Admin\AttributeOptions::index/$1/$2');
    $routes->post('attribute-options', 'Admin\AttributeOptions::store');
    $routes->put('attribute-options/(:num)/(:num)', 'Admin\AttributeOptions::update/$1/$2');
    $routes->delete('attribute-options/(:num)', 'Admin\AttributeOptions::destroy/$1');

    $routes->get('brands', 'Admin\Brands::index');
    $routes->get('brands/(:num)', 'Admin\Brands::index/$1');
    $routes->post('brands', 'Admin\Brands::store');
    $routes->put('brands/(:num)', 'Admin\Brands::update/$1');
    $routes->delete('brands/(:num)', 'Admin\Brands::destroy/$1');

    $routes->get('products', 'Admin\Products::index');
    $routes->get('products/create', 'Admin\Products::create');
    $routes->get('products/(:num)', 'Admin\Products::index/$1');
    $routes->get('products/(:num)/edit', 'Admin\Products::edit/$1');
    $routes->post('products', 'Admin\Products::store');
    $routes->put('products/(:num)', 'Admin\Products::update/$1');
    $routes->delete('products/(:num)', 'Admin\Products::destroy/$1');
    $routes->get('products/restore/(:num)', 'Admin\Products::restore/$1');
    $routes->get('products/(:num)/images', 'Admin\Products::images/$1');
    $routes->get('products/(:num)/upload-image', 'Admin\Products::uploadImage/$1');
    $routes->post('products/(:num)/upload-image', 'Admin\Products::doUploadImage/$1');
    $routes->delete('products/images/(:num)', 'Admin\Products::destroyImage/$1');
});
```

---

## 🗄️ Configuração do Banco de Dados

### Criar grupos de usuários

```sql
INSERT INTO auth_groups_users (user_id, group, created_at) VALUES
(1, 'admin', NOW()),
(2, 'operator', NOW());
```

### Criar usuário teste (via CLI)

```bash
docker exec -it ci46comercio_php sh
php spark shield:user create admin@exemplo.com senha123
```

---

## 🐳 Comandos Docker

### Reiniciar containers

```bash
docker-compose down
docker-compose up -d
```

### Limpar cache do CodeIgniter

```bash
docker exec -it ci46comercio_php sh
rm -rf /var/www/html/writable/cache/*
```

### Ver logs

```bash
docker-compose logs -f php
docker-compose logs -f nginx
```

---

## 🧪 Testes Finais

### 1. Verificar ambiente

- [ ] Acessar http://localhost:56100 (deve mostrar página inicial)
- [ ] Acessar http://localhost:56102 (Adminer - testar conexão banco)
- [ ] Verificar se Redis está rodando: `docker exec -it ci46comercio_redis redis-cli ping`

### 2. Testar autenticação

- [ ] Acessar http://localhost:56100/login
- [ ] Fazer login com usuário criado
- [ ] Acessar http://localhost:56100/admin/dashboard

### 3. Testar funcionalidades

- [ ] CRUD de Categorias
- [ ] CRUD de Marcas
- [ ] CRUD de Atributos
- [ ] CRUD de Produtos
- [ ] Upload de imagens

### 4. Verificar logs de erro

- [ ] `app/writable/logs/` - verificar se não há erros críticos

---

## 📝 Notas Importantes

- **IonAuth foi removido** - Sistema usa CodeIgniter Shield
- **Auth.php foi deletado** - Shield gerencia autenticação automaticamente
- **AutoRoute desabilitado** - Todas as rotas devem estar explícitas em Routes.php
- **PHP 8.3** - Aproveitar recursos modernos (match, readonly, etc)
- **Redis configurado** - Pronto para cache de sessões

---

## 🆘 Troubleshooting

### Erro: "Class 'service' not found"

- Verificar se BaseController está correto
- Usar `\Config\Services::auth()` ao invés de `service('auth')`

### Erro: "Filter 'admin-auth' not found"

- Verificar se AdminAuthFilter.php foi criado em `app/Filters/`
- Verificar se foi registrado em `Filters.php`

### Erro: "No such file or directory" em Models

- Verificar se todas as Entities foram copiadas para `app/Entities/`

### Erro de permissão em writable/

```bash
docker exec -it ci46comercio_php chmod -R 777 /var/www/html/writable
```

---

## ✅ Migração Completa

Quando todos os itens estiverem marcados, a migração está concluída! 🎉

---

## 📋 INSTALAÇÃO PASSO A PASSO

### PASSO 1: Substituir arquivos

```bash
# Copie os 3 arquivos baixados para as pastas corretas
```

### PASSO 2: Criar projeto CodeIgniter 4.6 (se ainda não criou)

```bash
cd C:\laragon\www\ci46comercio

# Criar pasta src se não existir
mkdir src

# Entrar na pasta src
cd src

# Instalar CodeIgniter 4.6 via Composer
composer create-project codeigniter4/appstarter . "^4.6"
```

### PASSO 3: Construir containers Docker

```bash
# Voltar para raiz do projeto
cd C:\laragon\www\ci46comercio

# Parar containers antigos (se existirem)
docker-compose down

# Limpar imagens antigas
docker-compose down --rmi all

# Construir nova imagem com PHP 8.3
docker-compose build --no-cache

# Subir containers
docker-compose up -d
```

### PASSO 4: Verificar se está funcionando

```bash
# Ver logs
docker-compose logs -f php

# Acessar container PHP
docker exec -it ci46comercio_php sh

# Dentro do container, verificar versão PHP
php -v
# Deve mostrar: PHP 8.3.x

# Verificar extensões instaladas
php -m
# Deve listar: intl, mbstring, mysqli, pdo_mysql, zip, curl, xml, gd, etc.
```

### PASSO 5: Acessar aplicação

- **Aplicação**: http://localhost:56100
- **Adminer (banco)**: http://localhost:56102
- **Redis**: localhost:56103

---

## ✅ CHECKLIST DE VERIFICAÇÃO

Após subir os containers, verifique:

- [ ] `docker ps` mostra 4 containers rodando (mysql, redis, adminer, php, nginx)
- [ ] http://localhost:56100 carrega a página padrão do CodeIgniter 4
- [ ] `docker exec -it ci46comercio_php php -v` mostra PHP 8.3.x
- [ ] Adminer conecta no banco (servidor: mysql, usuário: ci46comercio_user, senha: ci46comercio_P@ssw0rd_2024)

---

## ⚠️ PRÓXIMOS PASSOS (APÓS CONFIRMAR QUE ESTÁ FUNCIONANDO)

1. Migrar código do projeto antigo (CI 4.1) para o novo (CI 4.6)
2. Ajustar diferenças de sintaxe entre versões
3. Testar funcionalidades uma a uma
4. Corrigir erros específicos que aparecerem

---

## 🆘 PROBLEMAS COMUNS

### Erro: "bind: address already in use"

**Solução**: Algum serviço está usando as portas 56100, 56101, 56102 ou 56103

```bash
# Windows
netstat -ano | findstr :56100
# Mate o processo ou mude a porta no docker-compose.yml
```

### Erro: "Cannot connect to MySQL"

**Solução**: Aguarde o MySQL iniciar completamente

```bash
docker-compose logs mysql
# Procure por "ready for connections"
```

### Erro: "Permission denied" no container

**Solução**: Ajustar permissões da pasta src

```bash
docker exec -it ci46comercio_php chmod -R 777 /var/www/html/writable
```

---

## 📞 SUPORTE

Se aparecer qualquer erro, me envie:

1. O comando que executou
2. A mensagem de erro completa
3. O resultado de `docker-compose logs php`

Vamos resolver um problema de cada vez! 🎯
