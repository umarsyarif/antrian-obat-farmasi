<template>
  <div class="card card-default">
    <div class="card-header">
      <h5>History Antrian Obat</h5>
      <a
        href="javascript:void(0)"
        class="btn btn-sm btn-warning float-right"
        @click="print"
      >
        <i class="feather icon-printer"></i> Print
      </a>
    </div>
    <div id="print" class="card-block">
      <div class="dt-responsive table-responsive">
        <table
          id="simpletable"
          class="table table-striped table-bordered nowrap"
        >
          <thead>
            <tr>
              <th>#</th>
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
  props: ["pasien"],
  data() {
    return {
      terlambat: 0,
    };
  },
  methods: {
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
