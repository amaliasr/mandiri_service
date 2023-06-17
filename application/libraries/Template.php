<?php
class Template
{
    protected $_ci;

    function __construct()
    {
        $this->_ci = &get_instance();
    }

    function views($template = NULL, $data = NULL, $is_auth = NULL)
    {
        if ($template != NULL) {
            //META TAG
            $data['head'] = $this->_ci->load->view('templates/head', $data, TRUE);

            //META TAG
            $data['header'] = $this->_ci->load->view('templates/header', $data, TRUE);

            //CONTENT
            $data['content'] = $this->_ci->load->view($template, $data, TRUE);

            //FOOTER
            $data['footer'] = $this->_ci->load->view('templates/footer', $data, TRUE);

            //JS
            $data['js'] = $this->_ci->load->view('templates/js', $data, TRUE);

            //RESULT
            // if ($is_auth == NULL) {
            $data['combined'] = $this->_ci->load->view('templates/combined', $data, TRUE);
            // } else {
            //     $data['combined'] = $this->_ci->load->view('templates/auth', $data, TRUE);
            // }

            echo $data['combined'];
        }
    }
}
