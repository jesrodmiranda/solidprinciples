# solidprinciples
Los requisitos se cambian. Es una situación con la que tenemos que batallar cada jornada. De esto se concluye que, aparte del tiempo que se ha gastado en obtener los requisitos y las funcionalidades que se deben implementar, tu aplicación va a tener que cambiar. Es mejor estar preparado para ello.

Para asegurarse que los cambios no te tomen por sorpresa, es seguir estos 5 principios básicos de la programación orientada a objetos, explicados en “Agile Software Development: Principles, Patterns, and Practices” por uno de los grandes exponentes de la artesanía del software, el famoso “Uncle Bob” (Robert C. Martin)

Estos principios, cuyas primeras letras forman el acrónimo mnemotécnico SOLID (sólido), son los siguientes:

SINGLE RESPONSIBILITY PRINCIPLE
(PRINCIPIO DE RESPONSABILIDAD ÚNICA)
Cada componente, ya sean paquetes, clases, métodos e incluso bloques de código, debería tener una única razón para cambiar. Esto es, debe tener una única responsabilidad, ocuparse de una única tarea, para aumentar de esa forma la cohesión y reducir el acoplamiento.

Supongamos que tenemos una clase Pedido con dos métodos: cargar, que traería de la base de datos la información del pedido y de los productos que lo componen, y calcularCoste, que simplemente sumaría el precio de los productos, aplicando cualquier descuento pertinente.

Esto podría parecer un buen diseño, porque, al fin y acabo, ambos métodos se encargan de cosas relacionadas con los pedidos, pero la realidad es que la clase se encarga de tareas relacionadas con los pedidos y de tareas relacionadas con la base de datos.

OPEN CLOSED PRINCIPLE
(PRINCIPIO ABIERTO/CERRADO)
Todo componente debe estar abierto a nuevas funcionalidades, pero cerrado a cambios en su código. Queremos extender el comportamiento del componente sin modificar su código. ¿Cómo hacerlo? Mediante la abstracción, por ejemplo, el polimorfismo.

Supongamos que estoy programando un reproductor de audio, y tengo una clase Archivo con un método reproducir, que consiste en un switch que llama a un método u otro de la clase dependiendo de si el archivo es un MP3, un WMA o un OGG. Si quiero añadir un nuevo formato más tarde, tendré que modificar el switch, añadiendo una nueva expresión que llame a otra función. Si en lugar de utilizar un switch definimos reproducir como abstracto, y movemos la implementación a varias clases hijas, una por cada formato, cuando queramos añadir un nuevo formato, sólo necesitaremos crear una nueva clase hija.

LISKOV SUBSTITUTION PRINCIPLE
(PRINCIPIO DE SUSTITUCIÓN DE LISKOV)
Los objetos de una clase deberían poder sustituirse por instancias de las clases derivadas. Llamado así porque fue enunciada por primera vez por Barbara Liskov, premio Turing 2008, puede servirnos para determinar si nuestra jerarquía se ajusta al Principio Abierto/Cerrado.

El ejemplo típico es una clase Cuadrado que hereda de una clase Rectangulo. El ancho y alto de ambas clases se encapsulan mediante métodos get y set, pero en el caso del cuadrado, ambos métodos modifican ambos atributos, de forma que ambas dimensiones coincidan, como es de esperar para un cuadrado. Ahora bien, si el código cliente necesita saber con qué tipo está tratando para poder funcionar y responder adecuadamente, esto viola claramente el Principio Abierto/Cerrado.

INTERFACE SEGREGATION PRINCIPLE
(PRINCIPIO DE SEGREGACIÓN DE INTERFACES)
Crea pequeñas interfaces específicas para los clientes. Otra forma de expresarlo es que las clases que implementen una interfaz o una clase abstracta, no deberían estar obligadas a implementar métodos que no utilizan.

Supongamos que tenemos una clase abstracta TelefonoMovil con la que queremos representar tanto móviles actuales como viejas reliquias. No sería una gran idea crear un método fotografiar() en la clase padre, dado que no todos los teléfonos tienen esta funcionalidad. Aunque la implementación del método en la clase concreta consistiera en no hacer nada o lanzar una excepción, este diseño sólo serviría para crear confusión y dificultar el mantenimiento.

DEPENDENCY INVERSION PRINCIPLE
(PRINCIPIO DE INVERSIÓN DE DEPENDENCIAS)
Depende de abstracciones, no de implementaciones concretas.

Se llama así porque, al contrario de lo que sucede a veces, las clases concretas deberían depender de clases abstractas, y no a la inversa.

Supongamos que tenemos una clase que se encargará de gestionar la configuración de la aplicación, y esta utiliza (tiene una dependencia de) una clase que permite leer y escribir de un archivo de texto plano. Pero, ¿y si de repente decidimos que queremos utilizar una base de datos? ¿o un archivo XML? Lo ideal sería que nuestra clase utilizara una clase abstracta o una interfaz, en lugar de una implementación concreta, como era la clase para trabajar con archivos de texto plano.