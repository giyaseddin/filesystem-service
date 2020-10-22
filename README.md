### **Filesystem API Laravel Project**

This challenge is about building an API server serving files hosted on the local filesystem to the user. The project should serve files from a specific directory and subdirectories, and not anywhere outside. Implement an API endpoint for serving the files. The API will have an endpoint that'll receive the file path as a parameter, and return the contents to the user in an efficient manner. Think of the following issues while designing your backend: 
- how to specify configuration (location of the directory and other configuration you think is needed)
- how to serve huge files to users (>1GB) 
- how to scale up the number of users and support more concurrent requests

Implement the project in your language of choice, but include the whole project source including build tools, dependency manager, tests, and documentation. Your project will be evaluated based on readability, design, ease of use and adherence to standards in addition to design and implementation correctness. 

If you manage to finish the project in time, as a stretch goal implement support for remote HTTP files: If the user sends an HTTP URL, fetch the URL and serve it to the user, acting as a simple HTTP proxy. 


## **Introduction**
File hosting service, that serves files as data streams that is configurable storage options to handle concurrent requests, authorisations, and huge files.

## **Implementation**
The system uses Laravel MVC framework (PHP programming language), it contains a single endpoint that takes the path of the requested file, and returns the file.

For scalability purposes, it avoids writing directly to a desk, instead it returns a stream of data, this way the size of the file will not lock resources, thus will not cause a load on the server. This makes downloading huge files by multiple users less expensive.

Reference: https://laravel.com/docs/8.x/responses#streamed-downloads

## **System Setup**
Steps for configuring a typical laravel application can be found here:
``https://laravel.com/docs/8.x/installation``


## **Usage**
Requesting a file can be done by calling the API using ``[GET] /api/files`` endpoint. A parameter ``path`` of data type `string` is required to specify the path of the file.

An interactive API documentation interface (made with Swagger) can be found on ``/docs``

