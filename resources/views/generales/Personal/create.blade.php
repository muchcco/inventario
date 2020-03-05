
@extends('layout')

@section('style')
<link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />

@endsection
@section('script')
<script href="{{ asset('assets/js/pages/crud/forms/widgets/select2.js')}}" rel="stylesheet" type="text/css" ></script>
<script>



    $( document ).ready(function() {
        $("#Dependencia").select2( {
                placeholder:"Search for git repositories",
                allowClear:!0,
                ajax: {
                    url:"https://api.github.com/search/repositories",
                    dataType:"json",
                    delay:250,
                    data:function(e) {
                        return {
                            q: e.term, page: e.page
                        }
                    }
                    , processResults:function(e, t) {
                        return t.page=t.page||1, {
                            results:e.items, pagination: {
                                more: 30*t.page<e.total_count
                            }
                        }
                    }
                    , cache:!0
                },
                escapeMarkup:function(e) {
                    return e
                }
                , minimumInputLength:1, templateResult:function(e) {
                    if(e.loading)return e.text;
                    var t="<div class='select2-result-repository clearfix'><div class='select2-result-repository__meta'><div class='select2-result-repository__title'>"+e.full_name+"</div>";
                    return e.description&&(t+="<div class='select2-result-repository__description'>"+e.description+"</div>"), t+="<div class='select2-result-repository__statistics'><div class='select2-result-repository__forks'><i class='fa fa-flash'></i> "+e.forks_count+" Forks</div><div class='select2-result-repository__stargazers'><i class='fa fa-star'></i> "+e.stargazers_count+" Stars</div><div class='select2-result-repository__watchers'><i class='fa fa-eye'></i> "+e.watchers_count+" Watchers</div></div></div></div>"
                }
                , templateSelection:function(e) {
                    return e.full_name||e.text
                }
            }
            )



    //cargar datos al al encontrar el dni
        var  cargarDatos = () =>{
            dni = document.getElementById("dni").value;
            ajaxRequest(
                "{{ route('generales.personal.buscar') }}",
                'POST',
                {dni : dni},
                function(response){
                    document.getElementById("Nombres").value = response.prenombres;
                    document.getElementById("ApePat").value = response.apPrimer;
                    document.getElementById("ApeMat").value = response.apSegundo;
            });




        //console.log(document.getElementById("dni").value);
        //alert("!3")
    }
    });


    </script>
@endsection
@section('content')
<div class="row">
	<div class="col-md-6 offset-md-3">
		<!--begin::Portlet-->
		<div class="kt-portlet">
			<div class="kt-portlet__head">
				<div class="kt-portlet__head-label">
					<h3 class="kt-portlet__head-title">
						Nuevo Personal
					</h3>
				</div>
			</div>
			<!--begin::Form-->
			<form class="kt-form">
				<div class="kt-portlet__body">
                    <div class="form-group">
						<label>DNI</label>
						<div class="input-group">
							<input type="text" class="form-control" name="dni" id="dni">
							<div class="input-group-append">
								<a class="btn btn-success "  onclick="cargarDatos()"  style="color: #fff">Buscar</a>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label>Nombres</label>
						<input type="text" class="form-control" id="Nombres" name="Nombres" disabled="disabled">
					</div>
					<div class="form-group">
						<label>Apellido Paterno</label>
						<input type="text" class="form-control" id="ApePat" name="ApePat"  disabled="disabled">
					</div>
					<div class="form-group">
						<label>Apellido Paterno</label>
						<input type="text" class="form-control" id="ApeMat" name="ApeMat"  disabled="disabled">
                    </div>
					<div class="form-group">
						<label>Anexo</label>
						<input type="text" class="form-control" id="Anexo" name="Anexo">
                    </div>
					<div class="form-group">
						<label >Contrato</label>
						<select class="form-control" id="Contrato" id="Contrato">
							<option value="CAS">CAS</option>
							<option value="CAP">CAP</option>
							<option value="RHO">RHO</option>
						</select>
					</div>
					<div class="form-group">
						<label for="exampleSelect2">Example multiple select</label>
						<select class="js-example-data-ajax form-control" id="Dependencia" name="Dependencia">
                            <option value="1" selected="selected">select2/select2</option>
                            <option value="2">select2/select2</option>
                            <option value="3">select2/select2</option>
                            <option value="4">select2/select2</option>
                            <option value="5">select2/select2</option>
                          </select>
					</div>
				</div>
				<div class="kt-portlet__foot">
					<div class="kt-form__actions">
						<button type="reset" class="btn btn-primary">Submit</button>
						<button type="reset" class="btn btn-secondary">Cancel</button>
					</div>
				</div>
			</form>
			<!--end::Form-->
		</div>
		<!--end::Portlet-->

		<!--begin::Portlet-->

		<!--end::Portlet-->
	</div>

</div>


@endsection
