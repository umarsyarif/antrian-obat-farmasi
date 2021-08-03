<template>
  <div class="card card-default">
    <div class="card-header">
      <h5>History Antrian Obat</h5>
      <a
        href="javascript:void(0)"
        class="btn btn-sm btn-warning float-right"
        @click="print"
        v-if="user.is_admin"
      >
        <i class="feather icon-printer"></i> Print
      </a>
    </div>
    <div id="print" class="card-block">
      <div class="text-center">
        <h4>Laporan Farmasi RS Tabrani</h4>
        <p v-if="params.tanggal_awal && params.tanggal_akhir">
          {{ getFormattedDate(params.tanggal_awal) }} s/d
          {{ getFormattedDate(params.tanggal_akhir) }}
        </p>
        <p v-if="params.jenis_obat || params.jenis_pasien">
          Jenis obat : {{ params.jenis_obat ? params.jenis_obat : "-" }} | Jenis
          pasien : {{ params.jenis_pasien ? params.jenis_pasien : "-" }}
        </p>
      </div>
      <div class="dt-responsive table-responsive">
        <table
          id="simpletable"
          class="table table-striped table-bordered nowrap"
        >
          <thead>
            <tr>
              <th>No</th>
              <th>Nama</th>
              <th>Jenis Pasien</th>
              <th>Jenis Obat</th>
              <th>Tanggal</th>
              <th>Waktu Mulai</th>
              <th>Waktu Selesai</th>
              <th>Terlambat</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(row, index) in pasien" :key="row.id">
              <td>{{ index + 1 }}</td>
              <td>{{ row.nama }}</td>
              <td>{{ row.jenis_pasien }}</td>
              <td>{{ row.jenis_obat }}</td>
              <td>{{ getFormattedDate(row.created_at) }}</td>
              <td>{{ row.waktu_mulai }}</td>
              <td>
                {{ row.waktu_selesai ? row.waktu_selesai.split(" ")[1] : "-" }}
              </td>
              <td>{{ row.terlambat }}</td>
            </tr>
          </tbody>
          <tfoot>
            <tr>
              <th colspan="7">Terlambat</th>
              <th>{{ countTerlambat() }}</th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["pasien", "user"],
  data() {
    return {
      terlambat: 0,
      params: [],
    };
  },
  created() {
    this.params = {
      jenis_obat: this.getUrlParameter("jenis_obat"),
      jenis_pasien: this.getUrlParameter("jenis_pasien"),
      tanggal_awal: this.getUrlParameter("tanggal_awal"),
      tanggal_akhir: this.getUrlParameter("tanggal_akhir"),
    };
  },
  methods: {
    getUrlParameter(sParam) {
      var sPageURL = window.location.search.substring(1),
        sURLVariables = sPageURL.split("&"),
        sParameterName,
        i;

      for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split("=");

        if (sParameterName[0] === sParam) {
          return typeof sParameterName[1] === undefined
            ? true
            : decodeURIComponent(sParameterName[1]);
        }
      }
      return false;
    },
    countTerlambat() {
      var count = 0;
      this.pasien.forEach((element) => {
        if (element.terlambat != "-") {
          count++;
        }
      });
      return count;
    },
    print() {
      this.$htmlToPaper("print");
    },
    getFormattedDate(date) {
      date = new Date(date);
      var year = date.getFullYear();

      var month = (1 + date.getMonth()).toString();
      month = month.length > 1 ? month : "0" + month;

      var day = date.getDate().toString();
      day = day.length > 1 ? day : "0" + day;

      return day + "/" + month + "/" + year;
    },
  },
};
</script>
