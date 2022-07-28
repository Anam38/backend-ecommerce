<link rel="stylesheet" href="{{ asset ('templates/vendors/feather/feather.css') }}">
<link rel="stylesheet" href="{{ asset ('templates/vendors/ti-icons/css/themify-icons.css') }}">
<link rel="stylesheet" href="{{ asset ('templates/vendors/css/vendor.bundle.base.css') }}">
<!-- endinject -->
<!-- Plugin css for this page -->
<!-- <link rel="stylesheet" href="{{ asset ('templates/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}"> -->
<link rel="stylesheet" href="{{ asset ('templates/vendors/ti-icons/css/themify-icons.css') }}">
<link rel="stylesheet" href="{{ asset ('templates/vendors/mdi/css/materialdesignicons.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset ('templates/js/select.dataTables.min.css') }}">
<!-- notifikation css  -->
<link rel="stylesheet" type="text/css" href="{{ asset ('plugins/izi-toast/iziToast.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset ('plugins/datepicker/css/datepicker.css') }}">
<!-- End plugin css for this page -->
<!-- inject:css -->
<link rel="stylesheet" href="{{ asset ('templates/css/vertical-layout-light/style.css') }}">
<!-- endinject -->
<!-- datatable -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
<style media="screen">
  .card{
    box-shadow: 0px 5px 5px 0px #cdd1e1;
  }
  .sidebar{
    box-shadow: 0px 5px 5px 0px #cdd1e1;
  }
  .table{
    width: 100% !important;
  }
  .content-wrapper {
    padding: 1.375rem 1.375rem;
  }
  .table td{
    padding: 5px 10px;
  }
  .font-bold {
    font-weight: bold;
  }
  .card .card-button{
    width: auto;
  }
  .dock-card{
    position: absolute;
    top: 50%;
    left: 0;
    transition: all 300ms ease-out;
    -ms-transform: translateY(-50%);
    transform: translateY(-50%);
    background-color: #5c6bc0;
    text-align: center;
    width: 100%;
    color: #fff;
    text-transform: uppercase;
    font-weight: bold;
    padding: 10px;
    opacity: 0;
    cursor: pointer;
  }
  .card-custome:hover img{
    opacity: 0.5
  }
  .card-custome:hover .dock-card{
    opacity: 1
  }

  .dataTables_wrapper .dataTable .btn i{
    margin-right: 0.1rem;
  }
  /* select2 */
  .select2-container--default .select2-selection--single {
    padding: 7px;
    height: auto !important;
    border: 1px solid #ced4da !important;
  }
  .select2-container {
    width: 100% !important;
  }
  /* tags input style */
  .vue-tags-input {
    flex: 1 1 auto;
    max-width: none !important;
  }
  .ti-input{
    border-radius: 5px;
    padding: 10px !important;
  }
  .tags-input-with-button .ti-input{
    max-width: fit-content !important;
    min-width: 100%;
  }

  .ti-tag .ti-new-tag-input-wrapper {
    font-size: 0.875rem !important;
  }
  .ti-tag:before {
  	content: " " !important;
  }
  [class^="ti-"], [class*=" ti-"] {
    font-family: inherit !important;
  }
</style>
