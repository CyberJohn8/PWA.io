//--------------// Funciones //--------------//

const descripciondelproducto = document.getElementById("descripcion-producto");

const donar3 = document.getElementById("donate-3");
const donar5 = document.getElementById("donate-5");
const donar10 = document.getElementById("donate-10");

const cantidadinput = document.getElementById("amount-imput");
const montototal = document.getElementById("total-amount");

let contadordonar = 0;

//Botones de donaciones
donar3.addEventListener("click", () => {
    cantidadinput.value = 3;
    contadordonar = 3;
    updatemontototal();
});

donar5.addEventListener("click", () => {
    cantidadinput.value = 5;
    contadordonar = 5;
    updatemontototal();
});

donar10.addEventListener("click", () => {
    cantidadinput.value = 10;
    contadordonar = 10;
    updatemontototal();
});

//input manipulacion
cantidadinput.addEventListener("input", ()=> {
    contadordonar = cantidadinput.value;
    updatemontototal();
});

//actualizar el valor total
const updatemontototal = () => {
    const updatemontototal =  contadordonar * 50;
    montototal.innerText = updatemontototal;
};





//--------------// Mercado Pago //--------------//

//debemos conseguir y reemplazar la PUBLIC_KEY
const mercadopago = new MercadoPago('<PUBLIC_KEY>', {
    locale: '<es-AR>' // The most common are: 'pt-BR', 'es-AR' and 'en-US'
});

document.getElementById("checkout-btn").addEventListener("click", function () {
  
    const orderData = {
      quantity: 1,
      description: descripciondelproducto.innerText,
      price: montototal.innerText,
    };
  
    fetch("http://localhost:8080/create_preference", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(orderData),
    })
      .then(function (response) {
        return response.json();
      })
      .then(function (preference) {
        createCheckoutButton(preference.id);
      })
      .catch(function () {
        alert("Unexpected error");
      });

});




  //--------------// Funciones finales de Mercado Pago //--------------//
  
function createCheckoutButton(preferenceId) {
    // Initialize the checkout
    const bricksBuilder = mercadopago.bricks();
  
    const renderComponent = async (bricksBuilder) => {
      if (window.checkoutButton) window.checkoutButton.unmount();
      await bricksBuilder.create(
        'wallet',
        'button-checkout', // class/id where the payment button will be displayed
        {
          initialization: {
            preferenceId: preferenceId
          },
          callbacks: {
            onError: (error) => console.error(error),
            onReady: () => {}
          }
        }
      );
    };
    window.checkoutButton =  renderComponent(bricksBuilder);
}