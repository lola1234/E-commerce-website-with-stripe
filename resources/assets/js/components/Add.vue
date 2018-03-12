<template>
	<div class="row">		
		<button class="btn btn-success"  @click="add">Add to cart</button>
		
	</div>
	
</template>

<script>
	export default{	
		props:['product'],
		data(){
			return{
				loading: true
			}
		},
		methods:{
			add(){
				this.$store.commit('ADD', {id: this.product.id,
									qty:1,
									price: this.product.price,
									total: this.product.price
								});
				toastr.success('Added to cart');
				this.loading = false;
			}		
		}
	}
</script>