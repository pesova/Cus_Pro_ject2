document.addEventListener('DOMContentLoaded', getDashboard);

async function getDashboard() {

  let apiToken = "{{\Illuminate\Support\Facades\Cookie::get('api_token')}}";

  const res = await fetch(`https://dev.api.customerpay.me/dashboard?token=${apiToken}`);
  const data = await res.json();

  let myCustomers = document.querySelector('.my-customers');
  let myStores = document.querySelector('.my-stores');
  let myAssistants = document.querySelector('.my-assistants');
  let myDebtors = document.querySelector('.my-debtors');

  myCustomers.innerText = data.customers;

  console.log(data)


  // return data;

};


