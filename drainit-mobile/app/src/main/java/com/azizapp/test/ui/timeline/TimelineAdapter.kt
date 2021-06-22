package com.azizapp.test.ui.timeline

import android.os.Build
import android.view.LayoutInflater
import android.view.ViewGroup
import androidx.annotation.RequiresApi
import androidx.recyclerview.widget.RecyclerView
import com.azizapp.test.databinding.ItemTimelineBinding
import com.azizapp.test.model.Pengaduan
import java.sql.Timestamp
import java.time.*
import java.time.format.DateTimeFormatter
import java.util.*

class TimelineAdapter : RecyclerView.Adapter<TimelineAdapter.LaporanViewHolder>() {
    private var listLaporan = ArrayList<Pengaduan>()

    fun setData(items: ArrayList<Pengaduan>) {
        listLaporan.clear()
        listLaporan.addAll(items)
        notifyDataSetChanged()
    }

    inner class LaporanViewHolder(private val binding: ItemTimelineBinding) :
        RecyclerView.ViewHolder(binding.root) {
        @RequiresApi(Build.VERSION_CODES.O)
        fun bind(laporan: Pengaduan) {
            with(binding) {
                tvNama.text = laporan.namaPelapor
                tvTipe.text = laporan.tipePengaduan
                tvStatus.text = laporan.statusPengaduan
                tvDeskripsi.text = laporan.deskripsiPengaduan
                tvWaktu.text = printDifference(laporan.createdAt!!)
                tvId.text = laporan.id
//                tvUpvote.text = laporan.upvote
//                tvDownvote.text = laporan.downvote
            }
        }
    }

    override fun onCreateViewHolder(parent: ViewGroup, viewType: Int): LaporanViewHolder {
        val itemLaporanBinding =
            ItemTimelineBinding.inflate(LayoutInflater.from(parent.context), parent, false)
        return LaporanViewHolder(itemLaporanBinding)
    }

    @RequiresApi(Build.VERSION_CODES.O)
    override fun onBindViewHolder(holder: LaporanViewHolder, position: Int) {
        val laporan = listLaporan[position]
        holder.bind(laporan)
    }

    override fun getItemCount(): Int = listLaporan.size

    @RequiresApi(Build.VERSION_CODES.O)
    private fun printDifference(startDate: String): String {
        val formatter = DateTimeFormatter.ofPattern("yyyy-MM-dd HH:mm:ss", Locale.ENGLISH)
        val date = LocalDate.parse(startDate, formatter)

        val startDateDateformat = Date.from(date.atStartOfDay(ZoneId.systemDefault()).toInstant())

        val endDate = Timestamp(System.currentTimeMillis())
        val timestampString = endDate.toString().split(".")
        val now = LocalDate.parse(timestampString[0], formatter)
        val endDateDateformat = Date.from(now.atStartOfDay(ZoneId.systemDefault()).toInstant())
        //milliseconds
        var different = endDateDateformat.time - startDateDateformat.time
        println("startDate : $startDate")
        println("endDate : $endDate")
        println("different : $different")
        val secondsInMilli: Long = 1000
        val minutesInMilli = secondsInMilli * 60
        val hoursInMilli = minutesInMilli * 60
        val daysInMilli = hoursInMilli * 24
        val elapsedDays = different / daysInMilli
        different %= daysInMilli
        val elapsedHours = different / hoursInMilli
        different %= hoursInMilli
        val elapsedMinutes = different / minutesInMilli
        different %= minutesInMilli
        val elapsedSeconds = different / secondsInMilli
//    System.out.printf(
//        "%d hari yang lalu",
//        elapsedDays
//    )
        return "$elapsedDays hari yang lalu"
//    System.out.printf(
//        "%d hari, %d jam, %d menit, %d detik yang lalu",
//        elapsedDays, elapsedHours, elapsedMinutes, elapsedSeconds
//    )
    }
}