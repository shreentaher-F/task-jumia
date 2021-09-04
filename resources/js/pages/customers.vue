
<template>
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-10">
        <div class="card">
          <div class="card-header">{{title}}</div>

          <div class="card-body">

            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                    <th scope="col">Country</th>
                    <th scope="col">State</th>
                    <th scope="col">Country Code</th>
                    <th scope="col">Phone Num</th>
                    </tr>
                </thead>
                <tbody v-if="customers.length">
                    <tr v-for="(customer, key) in customers" :key="key">
                        <th scope="row">{{customer.country}}</th>
                        <td>{{customer.state ? 'Ok' : 'NOK'}}</td>
                        <td>{{customer.country_code}}</td>
                        <td>{{customer.phone}}</td>
                    </tr>
                </tbody>
                <tbody v-else>
                    <tr>
                        <td colspan="4" class="text-center">No Results</td>
                    </tr>
                </tbody>
            </table>

            <nav v-if="meta.last_page != 1" aria-label="Page navigation example">
                <ul class="pagination text-center">
                    <li class="page-item">
                    <a class="page-link" @click="prevPage" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                        <span class="sr-only">Previous</span>
                    </a>
                    </li>
                    <li :class="`page-item ${meta.current_page == page ? 'active' : ''}`"
                        v-for="(page, key) in meta.last_page" :key="key"
                    >
                        <a class="page-link" @click="onPageChange(page)">{{page}}</a>
                    </li>
                    <li class="page-item">
                    <a class="page-link" @click="nextPage" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                        <span class="sr-only">Next</span>
                    </a>
                    </li>
                </ul>
            </nav>

          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import RestService from './_services/RestService.js';

export default {
    data () {
        return {
            title: 'phone numbers',
            customers: [],
            meta: {
                current_page: 1
            },
            links: {},
            countries: []
        }
    },
    created () {

    },
    mounted () {
        this.getAll()
        this.getCountries()
    },
    methods: {
        async getAll() {
            await RestService.getAll(`?page=${this.meta.current_page}`)
                .then(res => {
                    this.customers = res.data.data
                    this.meta = res.data.meta
                    this.links = res.data.links
                }).catch(err => {
                console.log(err)
            })
        },
        async getCountries() {
            await RestService.getCountries()
                .then(res => {
                    this.countries = res.data
                }).catch(err => {
                console.log(err)
            })
        },
        /*
        * Handle page-change event
        */
        onPageChange (page) {
        this.meta.current_page = page
        this.getAll()
        },
        prevPage() {
            if (this.links.prev_page_url) {
                this.onPageChange(this.meta.current_page - 1)
            }
        },
        nextPage() {
            if (this.links.next_page_url) {
                this.onPageChange(this.meta.current_page + 1)
            }
        },
    }
}
</script>
