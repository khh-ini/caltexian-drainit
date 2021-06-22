package com.azizapp.test.ui.timeline

import android.os.Bundle
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import androidx.fragment.app.Fragment
import androidx.fragment.app.viewModels
import androidx.recyclerview.widget.LinearLayoutManager
import com.azizapp.test.databinding.FragmentTimelineFragmentBinding

class Fragment_Timeline : Fragment() {

    companion object {
        fun newInstance() = Fragment_Timeline()
    }

    private val viewModel: FragmentTimelineViewModel by viewModels()
    private lateinit var binding: FragmentTimelineFragmentBinding
    private lateinit var adapter: TimelineAdapter

    override fun onCreateView(
        inflater: LayoutInflater, container: ViewGroup?,
        savedInstanceState: Bundle?
    ): View {
        binding = FragmentTimelineFragmentBinding.inflate(layoutInflater, container, false)
        return binding.root
    }

    override fun onActivityCreated(savedInstanceState: Bundle?) {
        super.onActivityCreated(savedInstanceState)
        adapter = TimelineAdapter()

        viewModel.semuaLaporan.observe(viewLifecycleOwner) {
            adapter.setData(it)
            with(binding.rvLaporan) {
                adapter = this@Fragment_Timeline.adapter
                setHasFixedSize(true)
                layoutManager = LinearLayoutManager(context, LinearLayoutManager.VERTICAL, false)
            }
        }
    }
}