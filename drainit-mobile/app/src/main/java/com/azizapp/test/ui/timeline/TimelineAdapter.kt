package com.azizapp.test.ui.timeline

import android.os.Build
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import androidx.annotation.RequiresApi
import androidx.recyclerview.widget.RecyclerView
import com.azizapp.test.R
import com.azizapp.test.binding.loadImgFromUrl
import com.azizapp.test.databinding.ItemTimelineBinding
import com.azizapp.test.model.pengaduanvote.PengaduanWithVoteItem
import java.sql.Timestamp
import java.time.LocalDate
import java.time.ZoneId
import java.time.format.DateTimeFormatter
import java.util.*

class TimelineAdapter(val timelineViewModel: FragmentTimelineViewModel) :
    RecyclerView.Adapter<TimelineAdapter.LaporanViewHolder>() {
    private var listLaporan = ArrayList<PengaduanWithVoteItem>()

    fun setData(items: ArrayList<PengaduanWithVoteItem>) {
        listLaporan.clear()
        listLaporan.addAll(items)
        notifyDataSetChanged()
    }

    inner class LaporanViewHolder(itemView: View) :
        RecyclerView.ViewHolder(itemView) {
        val binding = ItemTimelineBinding.bind(itemView)

        @RequiresApi(Build.VERSION_CODES.O)
        fun bind(laporan: PengaduanWithVoteItem) {
            with(binding) {
                tvNama.text = laporan.namaPelapor
                tvTipe.text = laporan.tipePengaduan
                tvStatus.text = laporan.statusPengaduan
                tvDeskripsi.text = laporan.deskripsiPengaduan
                tvWaktu.text = printDifference(laporan.createdAt)
                tvDownvote.text = laporan.downvote.toString()
                tvUpvote.text = laporan.upvote.toString()
                ivLaporan.loadImgFromUrl(laporan.foto)

                when (laporan.vote) {
                    0 -> {
                        toggleDownvote.isChecked = true
                        toggleUpvote.isChecked = false
                    }
                    1 -> {
                        toggleUpvote.isChecked = true
                        toggleDownvote.isChecked = false
                    }
                }

                toggleUpvote.setOnCheckedChangeListener { _, isChecked ->
                    if (isChecked) {
                        toggleDownvote.isChecked = false
                        timelineViewModel.vote(laporan.id, true)
                        tvUpvote.text = (laporan.upvote + 1).toString()
                    } else {
                        timelineViewModel.voteUpdate(laporan.id, null)
                        tvUpvote.text = (laporan.upvote - 1).toString()
                    }
                }

                toggleDownvote.setOnCheckedChangeListener { buttonView, isChecked ->
                    if (isChecked) {
                        toggleUpvote.isChecked = false
                        timelineViewModel.vote(laporan.id, false)
                        tvDownvote.text = (laporan.downvote + 1).toString()
                    } else {
                        timelineViewModel.voteUpdate(laporan.id, null)
                        tvDownvote.text = (laporan.downvote - 1).toString()
                    }
                }
            }
        }
    }

    override fun onCreateViewHolder(
        parent: ViewGroup,
        viewType: Int
    ): LaporanViewHolder {
        val itemLaporanBinding: View =
            LayoutInflater.from(parent.context).inflate(R.layout.item_timeline, parent, false)
        return LaporanViewHolder(itemLaporanBinding)
    }

    @RequiresApi(Build.VERSION_CODES.O)
    override fun onBindViewHolder(holder: TimelineAdapter.LaporanViewHolder, position: Int) {
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
        return "$elapsedDays hari yang lalu"
    }
}