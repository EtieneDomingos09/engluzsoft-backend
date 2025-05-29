Esta documentação descreve todas as rotas da API do sistema **EngluzSoft**, com detalhes completos para facilitar o desenvolvimento do frontend em Next.js por parte do Gildo.

Todas as rotas seguem o prefixo `/api` e as protegidas requerem autenticação com **token JWT** gerado via **Sanctum**.

---

## 🔐 Autenticação

### POST `/api/login`

Realiza login e retorna um token para autenticação.

**Body:**

```
{
  "email": "teste@email.com",
  "password": "12345678"
}
```

**Resposta:**

```
{
  "token": "<TOKEN>",
  "user": { "id": 1, "name": "..." }
}
```

### POST `/api/logout`

Revoga o token do usuário autenticado. (Requer header Authorization).

**Resposta:**

```
{ "message": "Logout bem-sucedido" }
```

---

## 🏠 Imóveis (`properties`)

### GET `/api/properties`

Lista todos os imóveis (pública).

### GET `/api/properties/{id}`

Exibe detalhes de um imóvel.

### POST `/api/properties` _(protegida)_

Cria um novo imóvel.

### PUT `/api/properties/{id}` _(protegida)_

Atualiza os dados de um imóvel.

### DELETE `/api/properties/{id}` _(protegida)_

Remove um imóvel do sistema.

---

## 📸 Fotos (`photos`)

### GET `/api/properties/{id}/photos`

Lista as fotos de um imóvel.

### POST `/api/photos` _(protegida)_

Adiciona uma nova foto a um imóvel.

### DELETE `/api/photos/{id}` _(protegida)_

Remove uma foto de imóvel.

---

## ✨ Características (`features`)

### GET `/api/features`

Lista as características existentes.

### POST `/api/features` _(protegida)_

Cria uma nova característica.

### PUT `/api/features/{id}` _(protegida)_

Atualiza o nome de uma característica.

### DELETE `/api/features/{id}` _(protegida)_

Deleta uma característica.

---

## ❤️ Favoritos (`favorites`)

### GET `/api/users/{userId}/favorites` _(protegida)_

Lista os imóveis favoritados por um usuário.

### POST `/api/favorites` _(protegida)_

Adiciona um imóvel aos favoritos.

```
{
  "user_id": 1,
  "property_id": 10
}
```

### DELETE `/api/favorites` _(protegida)_

Remove um imóvel dos favoritos (via `user_id` e `property_id`).

---

## 📩 Mensagens (`messages`)

### GET `/api/users/{userId}/messages` _(protegida)_

Lista as mensagens enviadas/recebidas pelo usuário.

### POST `/api/messages` _(protegida)_

Envia uma nova mensagem.

```
{
  "sender_id": 1,
  "receiver_id": 2,
  "property_id": 5,
  "conteudo": "Olá, estou interessado."
}
```

### GET `/api/messages/{id}` _(protegida)_

Visualiza uma mensagem.

### DELETE `/api/messages/{id}` _(protegida)_

Remove uma mensagem.

---

## 📅 Visitas (`visits`)

### GET `/api/users/{userId}/visits` _(protegida)_

Lista visitas marcadas por um usuário.

### POST `/api/visits` _(protegida)_

Agenda uma nova visita:

```
{
  "user_id": 1,
  "property_id": 3,
  "data_hora": "2025-06-01 14:00:00"
}
```

### PUT `/api/visits/{id}` _(protegida)_

Atualiza visita (status ou data).

### DELETE `/api/visits/{id}` _(protegida)_

Cancela uma visita.

---

## 👀 Visualizações (`views`)

### GET `/api/properties/{id}/views`

Lista visualizações de um imóvel.

### POST `/api/views` _(protegida)_

Registra que um imóvel foi visualizado:

```
{
  "property_id": 5
}
```

---

## ⭐ Avaliações (`reviews`)

### GET `/api/properties/{id}/reviews`

Lista todas as avaliações do imóvel.

### POST `/api/reviews` _(protegida)_

Adiciona uma avaliação:

```
{
  "user_id": 1,
  "property_id": 5,
  "nota": 5,
  "comentario": "Excelente imóvel!"
}
```

### PUT `/api/reviews/{id}` _(protegida)_

Atualiza uma avaliação.

### DELETE `/api/reviews/{id}` _(protegida)_

Remove uma avaliação.

---

**Observações gerais para o Gildo:**

- Toda requisição protegida precisa de um header:
    
    ```
    Authorization: Bearer <token>
    ```
    
- O token é gerado no login e armazenado no frontend (ex: via context ou localStorage)
    
- Imóveis, mensagens, favoritos, etc. podem ser filtrados por `user_id` ou `property_id` conforme a necessidade
    
- Os campos de entrada devem ser sempre enviados em JSON