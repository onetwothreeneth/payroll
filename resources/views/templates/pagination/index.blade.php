<br> 
<div class="row">
	<div class="col-md-6"> 
		<ul class="c-pagination__list"> 
		    @for($i=1; $i <= round($pagination['pages']); $i++)
		        @if($i == $pagination['active'])
		            <li class="c-pagination__item"><a class="c-pagination__link is-active"><b>{{ $i }}</b></a></li> 
		        @else 
                    @if(isset($_GET['q']))
		            	<li class="c-pagination__item"><a class="c-pagination__link" href="?page={{ $i }}&q={{ $_GET['q'] }}">{{ $i }}</a></li> 
                    @else
		            	<li class="c-pagination__item"><a class="c-pagination__link" href="?page={{ $i }}">{{ $i }}</a></li> 
                    @endif 
		        @endif
		    @endfor
		</ul> 
	</div>
	<div class="col-md-6" style="text-align: right;"> 
		<small>
		    Page <b style="color: red;">{{ $pagination['active'] }}</b> 
		    of {{ $pagination['pages'] }} |
		    Total of <b style="color: red">{{ $pagination['total'] }}</b> 
		    result/s
		</small>
	</div>
</div>
	