<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <style>
        .font-wht-bold{
            font-weight: bold !important;
        }
        .d-flex{
            display: flex !important;
        }
        .m-auto{
            margin: auto !important;
        }
        .mt-1{
            margin-top: 10px !important;
        }
        .mt-2{
            margin-top: 20px !important;
        }
        .mt-3{
            margin-top: 30px !important;
        }
        .mt-4{
            margin-top: 40px !important;
        }
        .mt-5{
            margin-top: 50px !important;
        }
        .mt-6{
            margin-top: 60px !important;
        }
        .mt-7{
            margin-top: 70px !important;
        }
        .mt-8{
            margin-top: 80px !important;
        }
        .mb-1{
            margin-bottom: 10px !important;
        }
        .mb-2{
            margin-bottom: 20px !important;
        }
        .mb-3{
            margin-bottom: 30px !important;
        }
        .mb-4{
            margin-bottom: 40px !important;
        }
        .mb-5{
            margin-bottom: 50px !important;
        }
        .mb-6{
            margin-bottom: 60px !important;
        }
        .mb-7{
            margin-bottom: 70px !important;
        }
        .mb-8{
            margin-bottom: 80px !important;
        }
        .pt-1{
            padding-top: 10px !important;
        }
        .pt-2{
            padding-top: 20px !important;
        }
        .pt-3{
            padding-top: 30px !important;
        }
        .pt-4{
            padding-top: 40px !important;
        }
        .pt-5{
            padding-top: 50px !important;
        }
        .pt-6{
            padding-top: 60px !important;
        }
        .pt-7{
            padding-top: 70px !important;
        }
        .pt-8{
            padding-top: 80px !important;
        }
        .pb-1{
            padding-bottom: 10px !important;
        }
        .pb-2{
            padding-bottom: 20px !important;
        }
        .pb-3{
            padding-bottom: 30px !important;
        }
        .pb-4{
            padding-bottom: 40px !important;
        }
        .pb-5{
            padding-bottom: 50px !important;
        }
        .pb-6{
            padding-bottom: 60px !important;
        }
        .pb-7{
            padding-bottom: 70px !important;
        }
        .pb-8{
            padding-bottom: 80px !important;
        }
        .txt-center{
            text-align: center !important;
        }
        .container{
            background: #f2f2f2;
        }
        .container_context{
            background: white;
            width: 700px;
            padding: 30px;
        }
        .container_context figure a img{
            width: 350px;
        }
    </style>
</head>
<body>
    <div class="container pt-2 pb-2">
        <div class="container_context m-auto">
            <figure class="d-flex mb-6"><a class="m-auto" href="<?=BASE_URL;?>"><img src="https://project-cg.000webhostapp.com/Assets/store/images/logo/no-test/logo_text.png" alt=""></a></figure>
            <h3 class="txt-center">!GRACIAS POR TU COMPRA <?= strtoupper($variousData['name_user']) ." ". strtoupper($variousData['surname_user']); ?>!</h3>
            <p class="txt-center mt-1">Hemos recibido exitosamente tu pedido de compra. Número pedido <span class="font-wht-bold"><?=$variousData['num_order'];?></span>.</p>
            <p class="txt-center mt-1">Pedido realizado el <span class="font-wht-bold"><?=$variousData['dateCreate'];?></span>.</p>
            <?php
                Utils::dep($variousData);
            ?>
        </div>
    </div>
</body>
</html>