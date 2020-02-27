//Mercadopago.setPublishableKey("APP_USR-26be20c6-5fa2-42ea-8f8e-9eb144a1b718");
Mercadopago.getIdentificationTypes();

function addEvent(el, eventName, handler){
    if( !el ){
        return;
    }

    if (el.addEventListener) {
        el.addEventListener(eventName, handler);
    } else {
        el.attachEvent('on' + eventName, function(){
            handler.call(el);
        });
    }
};

function getBin() {
    var cardSelector = document.querySelector("#cardId");
    
    if (cardSelector && cardSelector[cardSelector.options.selectedIndex].value != "-1") {
        return cardSelector[cardSelector.options.selectedIndex].getAttribute('first_six_digits');
    }
    
    var ccNumber = document.querySelector('input[data-checkout="cardNumber"]');
    
    if( !ccNumber ){
        return '';
    }
    
    return ccNumber.value.replace(/[ .-]/g, '').slice(0, 6);
}

function clearOptions() {
    var bin = getBin();
    
    if (bin.length == 0) {
        const issuerEl = document.querySelector("#issuer");
        
        if( !issuerEl ){
            return;
        }
        
        issuerEl.style.display = 'none';
        issuerEl.innerHTML = "";

        var selectorInstallments = document.querySelector("#installments"),
        fragment = document.createDocumentFragment(),
        option = new Option("Opciones...", '-1');

        selectorInstallments.options.length = 0;
        fragment.appendChild(option);
        selectorInstallments.appendChild(fragment);
        selectorInstallments.setAttribute('disabled', 'disabled');
    }
}

function guessingPaymentMethod(event) {
    var bin = getBin(),
    amount = document.querySelector('#amount').value;
    
    if (event.type == "keyup") {
        if (bin.length == 6) {
            Mercadopago.getPaymentMethod({
                "bin": bin
            }, setPaymentMethodInfo);
        }
    } else {
        setTimeout(function() {
            if (bin.length >= 6) {
                Mercadopago.getPaymentMethod({
                    "bin": bin
                }, setPaymentMethodInfo);
            }
        }, 100);
    }
}

function setPaymentMethodInfo(status, response) {
    if (status == 200) {
        // do somethings ex: show logo of the payment method
        var form = document.querySelector('#form-gateway');

        if (document.querySelector("input[name=paymentMethodId]") == null) {
            var paymentMethod = document.createElement('input');
            paymentMethod.setAttribute('name', "paymentMethodId");
            paymentMethod.setAttribute('type', "hidden");
            paymentMethod.setAttribute('value', response[0].id);
            form.appendChild(paymentMethod);
        } else {
            document.querySelector("input[name=paymentMethodId]").value = response[0].id;
        }

        // check if the security code (ex: Tarshop) is required
        var cardConfiguration = response[0].settings,
        bin = getBin(),
        amountPar = document.querySelector('#amount').value;
        amount = parseFloat(amountPar);

        for (var index = 0; index < cardConfiguration.length; index++) {
            if (bin.match(cardConfiguration[index].bin.pattern) != null && cardConfiguration[index].security_code.length == 0) {
                /*
                * In this case you do not need the Security code. You can hide the input.
                */
            } else {
                /*
                * In this case you NEED the Security code. You MUST show the input.
                */
            }
        }

        Mercadopago.getInstallments({
            "bin": bin,
            "amount": amount
        }, setInstallmentInfo);

        // check if the issuer is necessary to pay
        var issuerMandatory = false,
            additionalInfo = response[0].additional_info_needed;

        for (var i = 0; i < additionalInfo.length; i++) {
            if (additionalInfo[i] == "issuer_id") {
                issuerMandatory = true;
            }
        };
        if (issuerMandatory) {
            Mercadopago.getIssuers(response[0].id, showCardIssuers);
            addEvent(document.querySelector('#issuer'), 'change', setInstallmentsByIssuerId);
        } else {
            document.querySelector("#issuer").style.display = 'none';
            document.querySelector("#issuer").options.length = 0;
        }
    }
}

function showCardIssuers(status, issuers) {
    var issuersSelector = document.querySelector("#issuer"),
    fragment = document.createDocumentFragment();

    issuersSelector.options.length = 0;
    var option = new Option("Opciones...", '-1');
    fragment.appendChild(option);

    for (var i = 0; i < issuers.length; i++) {
        if (issuers[i].name != "default") {
            option = new Option(issuers[i].name, issuers[i].id);
        } else {
            option = new Option("Otro", issuers[i].id);
        }
        fragment.appendChild(option);
    }
    issuersSelector.appendChild(fragment);
    issuersSelector.removeAttribute('disabled');
    document.querySelector("#issuer").removeAttribute('style');
}

function setInstallmentsByIssuerId(status, response) {
    var issuerId = document.querySelector('#issuer').value,
        amount = document.querySelector('#amount').value;

    if (issuerId === '-1') {
        return;
    }

    Mercadopago.getInstallments({
        "bin": getBin(),
        "amount": amount,
        "issuer_id": issuerId
    }, setInstallmentInfo);
}

var cuotas;
var arrayGateway; 

function setInstallmentInfo(status, response) {
    var selectorInstallments = document.querySelector("#installments"),
    fragment = document.createDocumentFragment();
    var form = document.querySelector('#form-gateway');
    selectorInstallments.options.length = 0;
    
    response.forEach(function (element) {
        if (element.processing_mode =="gateway") {
            document.getElementById('nombTarj').innerHTML =  element.payment_method_id;
            arrayGateway =element;
        } 
    });
    

    if (arrayGateway) {
        var option = new Option("Opciones...", '-1'),
        payerCosts = arrayGateway.payer_costs;
        cuotas = arrayGateway.payer_costs;
        var merchid = document.createElement('input');
     
        merchid.setAttribute('name', "merchId");
        merchid.setAttribute('type', "hidden");
        merchid.setAttribute('value', arrayGateway.merchant_account_id);
        form.appendChild(merchid);


        fragment.appendChild(option);
        for (var i = 0; i < payerCosts.length; i++) {
            option = new Option(payerCosts[i].recommended_message || payerCosts[i].installments, payerCosts[i].installments);
           
            if (arrayGateway.issuer.id == 5 && arrayGateway.issuer.name == "Naranja" && arrayGateway.payer_costs[i].installments== 11 ) {
                option.innerHTML = "PLAN Z" 
            }
             if ((arrayGateway.issuer.id == 1 || arrayGateway.issuer.id == 3 ) && (arrayGateway.issuer.name == "Visa Argentina S.A." || arrayGateway.issuer.name == "Mastercard" ) && arrayGateway.payer_costs[i].installments == 7) {
                option.innerHTML = "AHORA 12" 
            }

               if ((arrayGateway.issuer.id == 1 || arrayGateway.issuer.id == 3 ) && (arrayGateway.issuer.name == "Visa Argentina S.A." || arrayGateway.issuer.name == "Mastercard" ) && arrayGateway.payer_costs[i].installments == 8) {
                option.innerHTML = "AHORA 18" 
            }

             
            fragment.appendChild(option);
        }
        selectorInstallments.appendChild(fragment);
        selectorInstallments.removeAttribute('disabled');
    }
}

function cardsHandler() {
    clearOptions();
    var cardSelector = document.querySelector("#cardId");
    const amountEl = document.querySelector('#amount');
    
    if( amountEl )
        var amount = amountEl.value;

    if (cardSelector && cardSelector[cardSelector.options.selectedIndex].value != "-1") {
        var _bin = cardSelector[cardSelector.options.selectedIndex].getAttribute("first_six_digits");
        Mercadopago.getPaymentMethod({
            "bin": _bin
        }, setPaymentMethodInfo);
    }
}

addEvent(document.querySelector('input[data-checkout="cardNumber"]'), 'keyup', guessingPaymentMethod);
addEvent(document.querySelector('input[data-checkout="cardNumber"]'), 'keyup', clearOptions);
addEvent(document.querySelector('input[data-checkout="cardNumber"]'), 'change', guessingPaymentMethod);
cardsHandler();
doSubmit = false;

addEvent(document.querySelector('#form-gateway'),'submit',doPay);

function doPay(event){
    alert()
    event.preventDefault();
    if(!doSubmit){
        var $form = document.querySelector('#form-gateway');
        
        Mercadopago.createToken($form, sdkResponseHandler); 

        return false;
    }
}

function sdkResponseHandler(status, response) {
    if (status != 200 && status != 201) {
        alert("Verifique los datos ingresados");
    }else{
       
        var form = document.querySelector('#form-gateway');

        var card = document.createElement('input');
        card.setAttribute('name',"token");
        card.setAttribute('type',"hidden");
        card.setAttribute('value',response.id);
        form.appendChild(card);
      
        doSubmit=true;
        form.submit();
    }
}

function CFT(objeto){
    var indice = objeto.selectedIndex;
    var id = objeto.options[indice].value;

    for (i = 0; i < cuotas.length; i++){
        if (cuotas[i].installments == id){
            var cf = cuotas[i].labels[0];
            
            if(cf == "recommended_installment"){
                document.getElementById('CostoFT').innerHTML = cuotas[i].labels[1];
            }else {
                document.getElementById('CostoFT').innerHTML = cf;
            }
      
            var TotalCinteres  = cuotas[i].total_amount;

            document.getElementById('totCint').innerHTML = ' TOTAL C/INTERESES $' + TotalCinteres;
        }  
    }    
} 
