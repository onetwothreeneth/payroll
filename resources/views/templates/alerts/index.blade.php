@if(session('success')))
	<div class="alert-card c-alert c-alert--info animated fadeInDown">
	    <i class="c-alert__icon fa fa-check-circle"></i> {{ session('success') }}
	</div>
	<script type="text/javascript">
		setTimeout(() => {
			$('.alert-card').fadeOut()
		},3000);
	</script>

@elseif(session('error'))
	<div class="alert-card c-alert c-alert--danger animated fadeInDown">
	    <i class="c-alert__icon fa fa-check-circle"></i> {{ session('error') }}
	</div>
	<script type="text/javascript">
		setTimeout(() => {
			$('.alert-card').fadeOut()
		},3000);
	</script>
@endif 

<style>
	.alert-card{
		position: fixed;
		z-index: 100;
		width: 30%;
		top: 2%;
		right: 1%;
	}
</style>
