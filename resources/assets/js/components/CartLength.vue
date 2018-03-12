<template>
	<div class="row">		
		<a class="float-right" href="/cart" >
			<span data-feather="shopping-cart"></span>
			Cart({{ cartLength }})
		</a>  		
	</div>
	
</template>

<script>
	export default{	
		created(){
			this.cartLength;
		},
		computed:{
			cartLength(){
				return this.$store.getters.cartLength;
			}
		}
	}
</script>