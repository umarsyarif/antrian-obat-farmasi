<template>
  <div class="table-responsive-md">
    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Nama Pasien</th>
          <th scope="col">Jenis Obat</th>
          <th scope="col">Jenis Pasien</th>
          <th scope="col">Waktu</th>
          <th scope="col">Status</th>
          <th scope="col" class="text-center">Action</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(row, index) in pasien" :key="row.id" :class="getClass(row)">
          <td>{{ pasien.length - index }}</td>
          <td>{{ row.nama }}</td>
          <td>{{ row.jenis_obat }}</td>
          <td>{{ row.jenis_pasien }}</td>
          <td>{{ row.timer_count ? row.timer_count : "01:00:00" }}</td>
          <td>
            {{
              row.status
                ? "Udah Diambil"
                : row.status == null
                ? "Sedang Dibuat"
                : "Obat Selesai"
            }}
          </td>
          <td>
            <button class="btn btn-sm btn-info" @click="print(row.antrian)">
              <i class="feather icon-printer"></i> Print
            </button>
            <button
              v-if="row.status == 0"
              :class="`btn btn-sm float-right ${
                row.status == 1 ? 'btn-disabled' : 'btn-primary'
              }`"
              @click="updateStatus(row.id, true)"
            >
              Obat Diambil
            </button>
            <button
              v-if="row.status == null"
              :class="`btn btn-sm float-right mr-2 ${
                row.status != null ? 'btn-disabled' : 'btn-success'
              }`"
              @click="updateStatus(row.id, false)"
            >
              Obat Selesai
            </button>
          </td>
        </tr>
      </tbody>
    </table>
    <div id="print" class="col-12 d-none" style="height: 200px; border: 1px">
      <h3 class="text-center">RS Tabrani Pekanbaru</h3>
      <p class="text-center mt-3">Antrian Nomor</p>
      <h1 class="text-center mt-2">{{ printAntrian }}</h1>
    </div>
  </div>
</template>

<script>
export default {
  props: ["pasien", "time"],

  data() {
    return {
      printAntrian: "0",
    };
  },
  methods: {
    updateStatus(id, status) {
      this.$emit("statusupdated", id, status);
    },
    getClass(row) {
      var text = `${
        row.status ? "text-muted" : row.status != null ? "text-success" : ""
      }`;
      text = ` ${row.is_telat ? "text-danger" : text}`;
      return text;
    },
    print(no) {
      this.printAntrian = no;
      // Pass the element id here
      var ini = this;
      setTimeout(function () {
        ini.$htmlToPaper("print");
      }, 1000);
    },
    zeroPadding(num, digit) {
      var zero = "";
      for (var i = 0; i < digit; i++) {
        zero += "0";
      }
      return (zero + num).slice(-digit);
    },
    parseTime(diff) {
      var msec = diff;
      var hh = Math.floor(msec / 1000 / 60 / 60);
      msec -= hh * 1000 * 60 * 60;
      var mm = Math.floor(msec / 1000 / 60);
      msec -= mm * 1000 * 60;
      var ss = Math.floor(msec / 1000);
      msec -= ss * 1000;
      return `${this.zeroPadding(hh, 2)}:${this.zeroPadding(
        mm,
        2
      )}:${this.zeroPadding(ss, 2)}`;
    },
  },

  watch: {
    time: {
      handler(value) {
        var now = new Date();
        this.pasien.forEach((element) => {
          var createdAt = new Date(element.created_at);
          if (element.status !== null) {
            var cd = new Date(element.waktu_selesai);
            element.timer_count = this.parseTime(new Date(cd - createdAt));
            element.is_telat = cd - createdAt > 3600000;
          } else {
            element.timer_count = this.parseTime(new Date(now - createdAt));
            element.is_telat = now - createdAt > 3600000;
          }
        });
      },
      immediate: true, // This ensures the watcher is triggered upon creation
    },
  },
};
</script>

