<!DOCTYPE html>
<html lang="en" class="default-style layout-fixed layout-navbar-fixed">
    <!-- Mirrored from html.phoenixcoded.net/empire/bootstrap/default/pages_invoice-print.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 21 Jun 2020 11:02:16 GMT -->
    <head>
        <title>   {{ config('app.name') }} </title>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
        <meta name="description" content="Empire Pro Bootstrap admin template made using Bootstrap 4, it has tons of ready made feature, UI components, pages which completely fulfills any dashboard needs." />
        <meta
            name="keywords"
            content="admin template, bootstrap admin template, bootstrap dashboard, admin theme, dashboard template, bootstrap dashboard template, bootstrap admin panel, dashboard theme, best admin template, dashboard theme, website templates, bootstrap 4 admin template"
        />
        <meta name="author" content="Codedthemes" />
        <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico" />
        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet" />

        <link rel="stylesheet" href="assets/fonts/fontawesome.css" />
        <link rel="stylesheet" href="assets/fonts/ionicons.css" />
        <link rel="stylesheet" href="assets/fonts/linearicons.css" />
        <link rel="stylesheet" href="assets/fonts/open-iconic.css" />
        <link rel="stylesheet" href="assets/fonts/pe-icon-7-stroke.css" />
        <link rel="stylesheet" href="assets/fonts/feather.css" />

        <link rel="stylesheet" href="assets/css/bootstrap-material.css" />
        <link rel="stylesheet" href="assets/css/shreerang-material.css" />
        <link rel="stylesheet" href="assets/css/uikit.css" />

        <link rel="stylesheet" href="assets/libs/perfect-scrollbar/perfect-scrollbar.css" />
        <style>
            html,
            body {
                background: #fff !important;
            }

            body > :not(.invoice-print) {
                display: none !important;
            }

            .invoice-print {
                min-width: 768px !important;
                font-size: 15px !important;
            }

            .invoice-print * {
                border-color: #aaa !important;
                color: #000 !important;
            }
        </style>
    </head>
    <body>
        <div class="page-loader">
            <div class="bg-primary"></div>
        </div>

        <div class="invoice-print p-5">
            <div class="row">
                <div class="col-sm-6 pb-4">
                    <div class="media align-items-center mb-4">
                        <a href="index.html" class="navbar-brand app-brand demo py-0 mr-4">
                            <span class="app-brand-logo demo">
                                <img src="assets/img/logo-dark.png" alt="Brand Logo" class="img-fluid" />
                            </span>
                            <span class="app-brand-text demo font-weight-bold text-dark ml-2">Empire</span>
                        </a>
                    </div>
                    <div class="mb-1">Office 154, 330 North Brand Boulevard</div>
                    <div class="mb-1">Glendale, CA 91203, USA</div>
                    <div>+0 (123) 456 7891, +9 (876) 543 2198</div>
                </div>
                <div class="col-sm-6 text-right pb-4">
                    <h6 class="text-big text-large font-weight-bold mb-3">INVOICE #49029</h6>
                    <div class="mb-1">
                        Date:
                        <strong class="font-weight-semibold">January 12, 2015</strong>
                    </div>
                    <div>
                        Due date:
                        <strong class="font-weight-semibold">May 12, 2015</strong>
                    </div>
                </div>
            </div>
            <hr class="mb-4" />
            <div class="row">
                <div class="col-sm-6 mb-4">
                    <div class="font-weight-bold mb-2">Invoice To:</div>
                    <div>Alice Robart</div>
                    <div>Company LTD</div>
                    <div>09 Bowman St.</div>
                    <div>South Windsor, CT 06074</div>
                    <div>United States</div>
                    <div>+91 (999) 999 9999</div>
                    <div><a href="http://html.phoenixcoded.net/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="6d09180000142d000c0401430e0200">[email&#160;protected]</a></div>
                </div>
                <div class="col-sm-6 mb-4">
                    <div class="font-weight-bold mb-2">Payment Details:</div>
                    <table>
                        <tbody>
                            <tr>
                                <td class="pr-3">Total Due:</td>
                                <td>
                                    <strong>$6,095.25</strong>
                                </td>
                            </tr>
                            <tr>
                                <td class="pr-3">Bank name:</td>
                                <td>Finance Bank</td>
                            </tr>
                            <tr>
                                <td class="pr-3">Country:</td>
                                <td>United States</td>
                            </tr>
                            <tr>
                                <td class="pr-3">City:</td>
                                <td>West New York, NJ 07093</td>
                            </tr>
                            <tr>
                                <td class="pr-3">Address:</td>
                                <td>23 Sussex Ave.</td>
                            </tr>
                            <tr>
                                <td class="pr-3">IBAN:</td>
                                <td>ETD85039283901259</td>
                            </tr>
                            <tr>
                                <td class="pr-3">SWIFT code:</td>
                                <td>AS4F1</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="table-responsive mb-4">
                <table class="table m-0">
                    <thead>
                        <tr>
                            <th class="py-3">
                                Task description
                            </th>
                            <th class="py-3">
                                Rate
                            </th>
                            <th class="py-3">
                                Hours
                            </th>
                            <th class="py-3">
                                Line total
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="py-3">
                                <div class="font-weight-semibold">Website design and development</div>
                                <div class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.</div>
                            </td>
                            <td class="py-3">
                                <strong>$50.00</strong>
                            </td>
                            <td class="py-3">
                                <strong>63</strong>
                            </td>
                            <td class="py-3">
                                <strong>$3,150.00</strong>
                            </td>
                        </tr>
                        <tr>
                            <td class="py-3">
                                <div class="font-weight-semibold">Branding</div>
                                <div class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.</div>
                            </td>
                            <td class="py-3">
                                <strong>$47.95</strong>
                            </td>
                            <td class="py-3">
                                <strong>36</strong>
                            </td>
                            <td class="py-3">
                                <strong>$1,726.20</strong>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" class="text-right py-3">
                                Subtotal:
                                <br />
                                Tax(25%):
                                <br />
                                <span class="d-block text-big mt-2">Total:</span>
                            </td>
                            <td class="py-3">
                                <strong>$4,876.20</strong>
                                <br />
                                <strong>$1,219.05</strong>
                                <br />
                                <strong class="d-block text-big mt-2">$6,095.25</strong>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="text-muted">
                <strong>Note:</strong> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras laoreet, dolor id dapibus dapibus, neque mi tincidunt quam, quis congue ligula risus vitae magna. Curabitur ultrices nisi massa, nec
                viverra lorem feugiat sed. Mauris non porttitor nunc. Integer eu orci in magna auctor vestibulum.
            </div>
        </div>

        <script data-cfasync="false" src="../../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
        <script src="assets/js/pace.js"></script>
        <script src="assets/js/jquery-3.3.1.min.js"></script>
        <script src="assets/js/material-ripple.js"></script>
        <script src="assets/js/layout-helpers.js"></script>
        <script src="assets/libs/popper/popper.js"></script>
        <script src="assets/js/bootstrap.js"></script>
        <script src="assets/js/sidenav.js"></script>

        <script src="assets/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

        <script src="assets/js/demo.js"></script>
        <script src="assets/js/analytics.js"></script>
        <script>
            // -------------------------------------------------------------------------
            // Print on window load

            $(function () {
                window.print();
            });
        </script>
    </body>

    <!-- Mirrored from html.phoenixcoded.net/empire/bootstrap/default/pages_invoice-print.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 21 Jun 2020 11:02:16 GMT -->
</html>
