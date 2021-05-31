<template>
  <div class="table-responsive-md">
    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Nama Pasien</th>
          <th scope="col">Jenis Pasien</th>
          <th scope="col">Jenis Obat</th>
          <th scope="col">Status</th>
        </tr>
      </thead>
      <tbody>
        <tr
          v-for="(row, index) in antrian"
          :key="row.id"
          :class="row.status != null ? 'bg-success' : ''"
        >
          <td>{{ pasien.length - index }}</td>
          <td>{{ row.nama }}</td>
          <td>{{ row.jenis_pasien }}</td>
          <td>{{ row.jenis_obat }}</td>
          <td>
            {{
              row.status
                ? "Udah Diambil"
                : row.status == null
                ? "Sedang Dibuat"
                : "Obat Selesai"
            }}
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  props: ["pasien"],

  computed: {
    antrian: function () {
      return this.pasien.filter((i) => i.status !== 1);
    },
  },
};
</script>

