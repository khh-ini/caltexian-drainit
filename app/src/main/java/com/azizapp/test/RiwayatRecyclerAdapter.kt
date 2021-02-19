package com.azizapp.test

import android.content.Intent
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import android.widget.ImageView
import android.widget.TextView
import androidx.lifecycle.AndroidViewModel
import androidx.recyclerview.widget.RecyclerView
import com.azizapp.test.databinding.ItemListRiwayatBinding
import com.azizapp.test.model.Pengaduan
import com.azizapp.test.ui.riwayat.RiwayatViewModel
import com.bumptech.glide.Glide
import com.bumptech.glide.request.RequestOptions
import kotlinx.android.synthetic.main.item_list_riwayat.view.*
import org.w3c.dom.Text

class RiwayatRecyclerAdapter(val riwayatViewModel: RiwayatViewModel) : RecyclerView.Adapter<RiwayatRecyclerAdapter.RiwayatViewHolder>() {

    var items: ArrayList<Pengaduan>? = null

    override fun onCreateViewHolder(
        parent: ViewGroup,
        viewType: Int
    ): RiwayatRecyclerAdapter.RiwayatViewHolder {
        return RiwayatViewHolder(ItemListRiwayatBinding.inflate(
            LayoutInflater.from(parent.context),
            parent,
            false)
        )
    }

    override fun onBindViewHolder(holder: RiwayatViewHolder, itemPosition: Int) {
        val currentItem = items?.get(itemPosition)

        holder.binding.apply {
            viewModelRiwayat = riwayatViewModel
            position = itemPosition
            data = currentItem
        }
    }

    override fun getItemCount(): Int {
        return items!!.size
    }

    inner class RiwayatViewHolder(val binding: ItemListRiwayatBinding) :
        RecyclerView.ViewHolder(binding.root)
}