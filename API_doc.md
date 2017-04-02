**Create a author**
----
  Create a new author, and return json data about new author

* **URL**

  /author/create

* **Method:**

  `POST`
  
*  **URL Params**

   **Required:**
 
   `name=[string]`

* **Response Format**
    ```json
             {
                  "code" : "",  
                  "status": "",
                  "error": "",
                  "data" : {}
              }
    ```
        
* **Success Response:**
    ```json
         {
              "code" : "200",    
              "status": "success",
              "error": "",
              "data" : {
                "id":"1"
                "name":"luke"
              }
          }
    ```
 
* **Error Response:**    
     ```json
          {
               "code" : "406",  
               "status": "fail",
               "error": "Author name is required",
               "data" : []
           }
     ```


**Create a article**
----
  Create a article, and return json data about new article, article must belongs to a author 

* **URL**

  /article/create

* **Method:**

  `POST`
  
*  **URL Params**

   **Required:**
 
   `author_id=[integer]`
   `title=[string]`
   `url=[string]`
   `content=[string]`
   
* **Response Format**
   ```json
        {
             "code" : "",  
             "status": "",
             "error": "",
             "data" : {}
         }
   ```
* **Success Response:**
    ```json
         {
             "code" : "200",  
             "status": "success",
               "error": "",
               "data": {
                 "title": "Anewarticle",
                 "author": "'luke'",
                 "summary": "Article Content ... ...",
                 "url": "http://article.com/2",
                 "createdAt": "2017-04-02T17:17:57+1000"
               }
          }
    ```
 
* **Error Response:**    
     ```json
          {
               "code" : "406",  
               "status": "fail",
                 "error": [
                   {
                     "property_path": "url",
                     "message": "This value should not be blank."
                   }
                 ],
                 "data": [
                 ]
           }
     ```


**List all articles**
----
  List all articles with author's name, and return json data about articles 

* **URL**

  /article/list

* **Method:**

  `GET`
  
*  **URL Params**

   **Required:**
 
   `none`

   
* **Response Format**
   ```json
        {
             "code" : "",  
             "status": "",
             "error": "",
             "data" : {}
         }
   ```
* **Success Response:**
    ```json
         {
           "code" : "200",  
           "status": "success",
           "error": "",
           "data": [
             {
               "id": 5,
               "title": "Anewarticle",
               "author": "JimLee",
               "summary": "Article Content ... ...",
               "url": "http://article.com/1",
               "createdAt": "2017-04-02T17:15:18+1000"
             },
             {
               "id": 6,
               "title": "Anewarticle",
               "author": "LukeLu",
               "summary": "Article Content ... ...",
               "url": "http://article.com/2",
               "createdAt": "2017-04-02T17:17:57+1000"
             }
           ]
         }
    ```
 
* **Error Response:**    
     ```json
          {
               "code" : "406",  
               "status": "fail",
                 "error": "Service not available",
                 "data": [
                 ]
           }
     ```
     

**List one article**
----
  List one article with author's name, and return json data about article 

* **URL**

  /article/get/{id}

* **Method:**

  `GET`
  
*  **URL Params**

   **Required:**
 
   `id[integer]`

   
* **Response Format**
   ```json
        {
             "code" : "",  
             "status": "",
             "error": "",
             "data" : {}
         }
   ```
* **Success Response:**
    ```json
         {
           "code" : "200",  
           "status": "success",
           "error": "",
           "data": [
             {
               "id": 5,
               "title": "Anewarticle",
               "author": "JimLee",
               "summary": "Article Content ... ...",
               "url": "http://article.com/1",
               "createdAt": "2017-04-02T17:15:18+1000"
             }
           ]
         }
    ```
 
* **Error Response:**    
     ```json
          {
           "code" : "406",  
            "status": "fail",
            "error": "No article found",
            "data": [
            ]
          }
     ```     
     
     

**Update a article**
----
  Update a article, and return json data about article

* **URL**

  /article/update/{id}

* **Method:**

  `PUT`
  
*  **URL Params**

   **Required:**
 
   `id[integer]`

   
* **Response Format**
   ```json
        {
             "code" : "",  
             "status": "",
             "error": "",
             "data" : {}
         }
   ```
* **Success Response:**
    ```json
         {
           "code" : "200",  
           "status": "success",
           "error": "",
           "data": {
             "title": " New article name update",
             "summary": "Article Content ... ...",
             "url": "http://article.com/23",
             "createdAt": "2017-04-02T17:15:18+1000"
           }
         }
    ```
 
* **Error Response:**    
     ```json
          {
            "code" : "406",  
            "status": "fail",
            "error": [
              {
                "property_path": "url",
                "message": "This value is already used."
              }
            ]
          }
     ```     
     

**Delete a article**
----
  Delete a article based on given article id

* **URL**

  /article/delete/{id}

* **Method:**

  `DELETE`
  
*  **URL Params**

   **Required:**
 
   `id[integer]`

   
* **Response Format**
   ```json
        {
             "code" : "",  
             "status": "",
             "error": "",
             "data" : {}
         }
   ```
* **Success Response:**
    ```json
         {
           "code" : "200",  
           "status": "success",
           "error": "",
           "data": [
           ]
         }
    ```
 
* **Error Response:**    
     ```json
          {
            "code" : "406",  
            "status": "fail",
            "error": "No article found",
            "data": [
            ]
          }
     ```     