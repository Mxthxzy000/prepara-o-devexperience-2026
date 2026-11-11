<div align="center">

# HelpDesk Industrial · DevExperience 2026

**Sistema de abertura e gestão de chamados para ambientes industriais**

![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![HTML5](https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white)
![CSS3](https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge&logo=css3&logoColor=white)

</div>

---

## Sobre o projeto

Repositório de preparação da equipe **QGPDevs** para a competição **DevExperience 2026**. O módulo principal é um **HelpDesk Industrial**: uma aplicação web para registrar e acompanhar chamados de manutenção.

## Funcionalidades

- Criar chamados e salvá-los no banco de dados
- Visualizar, editar e remover chamados
- Pesquisar chamados por filtro ou por nome
- Navegação entre as páginas da plataforma

## Como rodar (XAMPP)

1. Copie a pasta [`Modulo_A/HELPDESK_INDUSTRIAL`](./Modulo_A/HELPDESK_INDUSTRIAL) para `htdocs` do XAMPP.
2. Inicie **Apache** e **MySQL** no painel do XAMPP.
3. Em `http://localhost/phpmyadmin`, crie o banco `helpdesk_industrial` e importe [`Modulo_A/banco.sql`](./Modulo_A/banco.sql).
4. Acesse `http://localhost/HELPDESK_INDUSTRIAL/pages/homePage`.

Mais detalhes em [`Modulo_A/README_Mod_A.md`](./Modulo_A/README_Mod_A.md).

## Estrutura

```
├── Modulo_A/   # HelpDesk Industrial (PHP + MySQL)
├── Modulo_B/   # Em desenvolvimento
└── Modulo_C/   # Em desenvolvimento
```

## Equipe QGPDevs

- Matheus Quirino Rosa Julio
- Otavio Gonçalez de Paula
- [Luiz Paulo Pereira Virginio](https://github.com/luixppereira)

> Projeto educacional desenvolvido para a competição DevExperience 2026.
