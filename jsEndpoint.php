<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
</head>

<body>
    <section id="faq" class="container bg-primary">
        <h1 class="text-light p-4 text-center">Preguntas Frecuentes</h1>
        <div class="accordion pb-4" id="accordionPanelsStayOpenExample">
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                        Accordion Item #2 este elemento
                    </button>
                </h2>
                <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse">
                    <div class="accordion-body">
                        <strong>This is the second item’s accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It’s also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
                        Accordion Item #3
                    </button>
                </h2>
                <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse">
                    <div class="accordion-body">
                        <strong>This is the third item’s accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It’s also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.js" integrity="sha512-+k1pnlgt4F1H8L7t3z95o3/KO+o78INEcXTbnoJQ/F2VqDVhWoaiVml/OEHv9HsVgxUaVW+IbiZPUJQfF/YxZw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        const datos = [{
                id: 1,
                titulo: "Preguntacion 1",
                respuesta: "Respuestacion 1",
                activo: true
            },
            {
                id: 2,
                titulo: "Preguntacion 2",
                respuesta: "Respuestacion 2",
                activo: true
            },
        ];

        //cargarFAQJS(datos, 'accordionPanelsStayOpenExample');

        function cargarFAQJS(_data, _div) {
            const div = document.getElementById(_div);
            div.innerHTML = '';
            _data.forEach(element => {
                const itemAcordeon = document.createElement('div');
                itemAcordeon.innerHTML = `
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapse${element.id}" aria-expanded="false" aria-controls="panelsStayOpen-collapse${element.id}">
                                ${element.titulo}
                            </button>
                        </h2>
                        <div id="panelsStayOpen-collapse${element.id}" class="accordion-collapse collapse">
                            <div class="accordion-body">
                                ${element.respuesta}
                            </div>
                        </div>
                    </div>
                `;
                div.appendChild(itemAcordeon);
            });
        }

        const endpointFAQ = 'https://www.clinicatecnologica.cl/ipss/tejelanasVivi/api/v1/faq/';
        const tokenGet = 'ipss.get';

        getEndpointTV_jQuery_FAQ(endpointFAQ, tokenGet);

        function getEndpointTV_jQuery_FAQ(_endpoint, _bearerToken) {

            const ajaxOptions = {
                url: _endpoint,
                method: 'GET',
                dataType: 'json', // Espera una respuesta JSON
                headers: {
                    'Content-Type': 'application/json'
                },
                success: function(data) {
                    //console.log(data.data);
                    //buildAcordeonHTML(data.data, 'accordionFlushBuildfaq');
                    cargarFAQJS(data.data, 'accordionPanelsStayOpenExample');
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error("Error al obtener datos:");
                    console.error("  Estado del texto:", textStatus); // Ej: "error", "timeout", "abort", "parsererror"
                    console.error("  Error lanzado:", errorThrown); // El error de la excepción (si la hay)
                    console.error("  Objeto jqXHR:", jqXHR); // Contiene detalles de la respuesta de error
                    console.error("  Código de estado HTTP (jqXHR.status):", jqXHR.status);
                    console.error("  Respuesta del servidor (jqXHR.responseText):", jqXHR.responseText);
                    // Aquí puedes manejar errores de la petición
                }
            };

            if (_bearerToken) {
                ajaxOptions.headers['Authorization'] = `Bearer ${_bearerToken}`;
            }

            $.ajax(ajaxOptions);
        }
        
    </script>
</body>

</html>
