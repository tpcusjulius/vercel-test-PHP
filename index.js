// Primera api
// fetch('http://127.0.0.1/devjuliuscommerce/apis/find-product-by-id-atd.php', {
//     method: 'POST',
//     headers: {
//       'Content-Type': 'application/x-www-form-urlencoded'
//     },
//     body: 'id=2056900'
//   })
//     .then(response => response.json())
//     .then(data => console.log(data))
//     .catch(error => console.error(error));

// segunda api

fetch('http://127.0.0.1/devjuliuscommerce/apis/update-or-create-product-shopify.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/x-www-form-urlencoded'
    },
    body: 'id=136130'
  })
    .then(response => response.json())
    .then(data => console.log(data))
    .catch(error => console.error("falle"));