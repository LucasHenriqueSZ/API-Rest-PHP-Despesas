## API Rest Despesas

API para o gerenciamento de despesas domésticas

### Tecnologias 
![PHP](	https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)


### Funcionalidades

- [Listar despesas](#Listar-despesas)
- [Cadastrar despesas](#Cadastrar-despesas)
- [Consultar despesas](#Consultar-despesas)
- [Listar categorias](#Listar-categorias)
- [Consultar categoria](#Consultar-categoria)
- [Listar Tipos de pagamentos](#Listar-tipos-de-pagamentos)
- [Consultar tipo de pagamento](#Consultar-tipo-de-pagamento)
- [Listar despesas por paginação](#Listar-despesas-por-paginação)
- [PDF de despesas por intervalo de tempo](#PDF-de-despesas-por-intervalo-de-tempo)
- [Excel das despesas do mês vigente](#Excel-das-despesas-do-mês-vigente)
- [Cadastrar categoria](#Cadastrar-categoria)
- [Editar despesa](#Editar-despesa)
- [Editar categoria](#Editar-categoria)
- [Excluir despesa](#Excluir-despesa)
- [Excluir categoria](#Excluir-categoria)





## Listar despesas

```
  GET /api/despesas/ 
```

- resposta:
        
      {
            "data": [
        {
            "id": "1",
            "valor": "550.2",
            "data_compra": "2023-01-23 12:45:56",
            "descricao": "Aluguel mensal",
            "tipo_pagamento_id": {
                "id": "3",
                "tipo": "credito"
              },
            "categoria_id": {
                "id": "1",
                "nome": "aluguel",
                "descricao": "Aluguel mensal"
              }
        },
        {
            "id": "2",
            "valor": "250.5",
            "data_compra": "2023-01-26 12:45:56",
            "descricao": "despesas com alimentacao",
            "tipo_pagamento_id": {
                "id": "2",
                "tipo": "debito"
              },
            "categoria_id": {
                "id": "3",
                "nome": "alimentacao",
                "descricao": "custos com alimentacao"
              }
        }
      ],
          "sucess": "true"
      }
  

## Cadastrar despesas

```
  POST /api/despesas/
```

- body:

        {
           "valor": "250.50",
           "data_compra": "2023-01-26 12:45:56",
           "descricao": "despesa com alimentacao",
           "tipo_pagamento": "debito",
           "categoria": "alimentacao"
        }

- Resposta:

        {
            "data": {
                "id da despesa inserida": "1"
            },
            "sucess": "true"
        }

- Resposta erros:

        {"erro":"Todos os campos devem ser preenchidos"}

## Consultar despesas

```
  GET /api/despesas/consultar/{id}
```
- Resposta:

        {
            "data": {
                "id": "2",
                "valor": "700",
                "data_compra": "2020-11-13 15:33:24",
                "descricao": "pagamento do aluguel",
                "tipo_pagamento_id": {
                    "id": "4",
                    "tipo": "pix"
                },
                "categoria_id": {
                    "id": "1",
                    "nome": "aluguel",
                    "descricao": "Aluguel mensal"
                }
            },
            "sucess": "true"
        }

- Resposta erros:

      {"erro":"Id nao pode ser nulo"}
      {"erro":"Nenhum registro encontrado"}         


## Listar categorias

```
  GET /api/despesas/listarCategorias
```
- Resposta:

      {
          "data": [
              {
                  "id": "1",
                  "nome": "aluguel",
                  "descricao": "Aluguel mensal"
              },
              {
                  "id": "3",
                  "nome": "alimentacao",
                  "descricao": "custos com alimentacao"
              },
              {
                  "id": "4",
                  "nome": "saude",
                  "descricao": "despesa com  plano de saude, dentista, remedios"
              }
          ],
          "sucess": "true"
      }

       

- Resposta erros:

      {"erro":"Nenhum registro encontrado"}


## Consultar categoria

```
  GET /api/despesas/categoria/{id}
```
- Resposta:

      {
          "data": {
              "id": "4",
              "nome": "saude",
              "descricao": "despesa com  plano de saude,dentista, remedios"
          },
          "sucess": "true"
      }
       
- Resposta erros:

      {"erro":"Nenhum registro encontrado"} 
      {"erro":"Id nao pode ser nulo"}        

## Listar Tipos de pagamentos

```
  GET /api/despesas/listarTiposPagamento
```
- Resposta:

      {
        "data": [
            {
                "id": "1",
                "tipo": "dinheiro"
            },
            {
                "id": "2",
                "tipo": "debito"
            },
            {
                "id": "3",
                "tipo": "credito"
            },
            {
                "id": "4",
                "tipo": "pix"
            }
        ],
        "sucess": "true"
      }

- Resposta erros:

      {"erro":"Nenhum registro encontrado"}

## Consultar tipo de pagamento

```
  GET /api/despesas/tipopagamento/{id}
```
- Resposta:

      {
          "data": {
              "id": "2",
              "tipo": "debito"
          },
          "sucess": "true"
      }


- Resposta erros:

      {"erro":"Nenhum registro encontrado"} 
      {"erro":"Id nao pode ser nulo"}        

## Listar despesas por paginação

```
  GET /api/despesas/listaDespesas/{id}/{id}
```
- Resposta:

      {
          "data": [
              {
                  "id": "8",
                  "valor": "300.5",
                  "data_compra": "2023-01-30 16:55:10",
                  "descricao": "desesa com mercado",
                  "tipo_pagamento_id": {
                      "id": "3",
                      "tipo": "credito"
                  },
                  "categoria_id": {
                      "id": "3",
                      "nome": "alimentacao",
                      "descricao": "custos com alimentacao"
                  }
              },
              {
                  "id": "9",
                  "valor": "250.5",
                  "data_compra": "2023-01-26 12:45:56",
                  "descricao": "despesa com alimentacao",
                  "tipo_pagamento_id": {
                      "id": "2",
                      "tipo": "debito"
                  },
                  "categoria_id": {
                      "id": "3",
                      "nome": "alimentacao",
                      "descricao": "custos com alimentacao"
                  }
              }
          ],
          "sucess": "true"
      }
       
- Resposta erros:

      {"erro":"Nenhum registro encontrado"} 
      {"erro":"Os ids nao podem ser nulos e o id1 deve ser menor que o id2"}  

      
## PDF de despesas por intervalo de tempo

```
  GET /api/despesas/pdfdespesas.pdf/{data}/{data}
```
- Resposta:

Gera o PDF com as despesas do intervalo de tempo informado
![PDF](https://firebasestorage.googleapis.com/v0/b/lucas-henrique-d45fe.appspot.com/o/pdfExamplo.png?alt=media&token=faf3f742-2e61-4193-9294-332dc7b7d915)

- Resposta erros:

      {"erro":"Nenhum registro encontrado"} 
      {"erro":"Data invalida"}
      {"erro":"Data inicial nao pode ser maior que a data final"}

## Excel das despesas do mês vigente

```
  GET /api/despesas/excelDespesas
```

- Resposta:

    Faz o download do arquivo Excel com as despesas do mes vigente
    ![Excel](https://firebasestorage.googleapis.com/v0/b/lucas-henrique-d45fe.appspot.com/o/ExcelExamplo.png?alt=media&token=fd3be1f3-b363-4ca3-95c6-526e32d79198)



- Resposta erros:

        {"erro":"Nenhum registro encontrado"}
        
## Cadastrar categoria

```
  POST /api/despesas/cadastrarCategoria
```

- body:

      {
        "nome": "saude",
         "descricao": "despesa com  plano de saude, dentista, remedios"
      }

- Resposta:

        {
            "data": {
                "id da categoria inserida": "4"
            },
            "sucess": "true"
        }

- Resposta erros:

        {"erro":"Todos os campos devem ser preenchidos"}

        
## Editar despesa

```
  PUT /api/despesas/editarDespesa/{id}
```

- body:

       {
           "valor": "150.5",
           "data_compra": "2023-02-15 17:45:56",
           "descricao": "despesa com alimentacao",
           "tipo_pagamento": "pix",
           "categoria": "alimentacao"
       }


- Resposta:
      
      
      {
          "data": {
              "id da despesa alterada": "{id}"
          },
          "sucess": "true"
      }


- Resposta erros:

        {"erro":"Erro ao atualizar registro"}

       
## Editar categoria

```
  PUT /api/despesas/editarDespesa/{id}
```

- body:

       {
          "nome": "alimentacao mes",
          "descricao": "custos com alimentacao mensal"
       }


- Resposta:
      
      
        {
          "data": {
               "id da categoria atualizada": "3"
          },
           "sucess": "true"
        }


- Resposta erros:

        {"erro":"Erro ao atualizar registro"}

       
## Excluir despesa

```
  DELETE /api/despesas/excluirDespesa/{id}
```

- Resposta:
      
        {
            "data": {
                "mensagem": "Registro excluido com sucesso"
            },
            "sucess": true
        }


- Resposta erros:

        {"erro":"Id nao pode ser nulo"}
        {"erro":"Erro ao excluir registro"}

## Excluir categoria

```
  DELETE /api/despesas/excluirCategoria/{id}
```

- Resposta:
      
        {
            "data": {
                "mensagem": "Registro excluido com sucesso"
            },
            "sucess": true
        }


- Resposta erros:

        {"erro":"Id nao pode ser nulo"}
        {"erro":"Erro ao excluir registro"}

