<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* modules/custom/airchoice_member/templates/page-dashboard.html.twig */
class __TwigTemplate_70e4262951015f4ffa584f8edcf973c69f7cf19feb83f9892d6cc8a926ad7a4d extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $tags = ["if" => 5, "for" => 235];
        $filters = ["escape" => 42, "length" => 233];
        $functions = ["path" => 9, "drupal_view" => 62, "dump" => 242];

        try {
            $this->sandbox->checkSecurity(
                ['if', 'for'],
                ['escape', 'length'],
                ['path', 'drupal_view', 'dump']
            );
        } catch (SecurityError $e) {
            $e->setSourceContext($this->getSourceContext());

            if ($e instanceof SecurityNotAllowedTagError && isset($tags[$e->getTagName()])) {
                $e->setTemplateLine($tags[$e->getTagName()]);
            } elseif ($e instanceof SecurityNotAllowedFilterError && isset($filters[$e->getFilterName()])) {
                $e->setTemplateLine($filters[$e->getFilterName()]);
            } elseif ($e instanceof SecurityNotAllowedFunctionError && isset($functions[$e->getFunctionName()])) {
                $e->setTemplateLine($functions[$e->getFunctionName()]);
            }

            throw $e;
        }

    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        // line 1
        echo " <div class='alert jumbotron members-addsection'>
    <div class='members-addsection-header'>  
        <div class='members-addsection-headerh1'><h1>Manage Members</h1></div>
        <div class='members-addmembers'>
            ";
        // line 5
        if ($this->getAttribute(($context["data"] ?? null), "canAddMoreMembers", [])) {
            // line 6
            echo "            <a class=\"use-ajax btn btn-success\"
            data-dialog-options=\"{&quot;width&quot;:600}\"  
            data-dialog-type=\"modal\"
            href=\"";
            // line 9
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar($this->env->getExtension('Drupal\Core\Template\TwigExtension')->getPath("airchoice_member.add_member_form"));
            echo "\"><svg viewBox=\"0 0 100 100\"><g>
\t\t\t\t\t\t  <path d=\"m25 46.43h-0.050781c-1.9727 0-3.5703 1.5977-3.5703 3.5703 0 1.9766 1.5977 3.5703 3.5703 3.5703h0.054687 49.992 0.050781c1.9727 0 3.5703-1.5977 3.5703-3.5703 0-1.9766-1.5977-3.5703-3.5703-3.5703h-0.054687z\"></path>
\t\t\t\t\t\t  <path d=\"m53.57 25v-0.050781c0-1.9727-1.5977-3.5703-3.5703-3.5703-1.9766 0-3.5703 1.5977-3.5703 3.5703v0.054687-0.003906 49.996 0.050781c0 1.9727 1.5977 3.5703 3.5703 3.5703 1.9766 0 3.5703-1.5977 3.5703-3.5703v-0.054687 0.003906z\"></path>
\t\t\t\t\t\t  <path d=\"m50 0c-27.57 0-49.996 22.43-49.996 49.996 0 27.57 22.43 49.996 49.996 49.996 27.57 0 49.996-22.43 49.996-49.996 0-27.57-22.43-49.996-49.996-49.996zm0 7.1445c23.711 0 42.855 19.148 42.855 42.855 0 23.711-19.145 42.855-42.855 42.855s-42.855-19.145-42.855-42.855 19.145-42.855 42.855-42.855z\"></path></g></svg>Add New Member</a>
            ";
        } else {
            // line 14
            echo "            <a class=\"btn btn-success\" href=\"javascript:void(0)\" disabled><svg viewBox=\"0 0 100 100\"><g>
\t\t\t\t\t\t  <path d=\"m25 46.43h-0.050781c-1.9727 0-3.5703 1.5977-3.5703 3.5703 0 1.9766 1.5977 3.5703 3.5703 3.5703h0.054687 49.992 0.050781c1.9727 0 3.5703-1.5977 3.5703-3.5703 0-1.9766-1.5977-3.5703-3.5703-3.5703h-0.054687z\"></path>
\t\t\t\t\t\t  <path d=\"m53.57 25v-0.050781c0-1.9727-1.5977-3.5703-3.5703-3.5703-1.9766 0-3.5703 1.5977-3.5703 3.5703v0.054687-0.003906 49.996 0.050781c0 1.9727 1.5977 3.5703 3.5703 3.5703 1.9766 0 3.5703-1.5977 3.5703-3.5703v-0.054687 0.003906z\"></path>
\t\t\t\t\t\t  <path d=\"m50 0c-27.57 0-49.996 22.43-49.996 49.996 0 27.57 22.43 49.996 49.996 49.996 27.57 0 49.996-22.43 49.996-49.996 0-27.57-22.43-49.996-49.996-49.996zm0 7.1445c23.711 0 42.855 19.148 42.855 42.855 0 23.711-19.145 42.855-42.855 42.855s-42.855-19.145-42.855-42.855 19.145-42.855 42.855-42.855z\"></path></g></svg>Add New Member ☹️ </a>
            ";
        }
        // line 19
        echo "        </div>
    </div>
       ";
        // line 22
        echo "    <div class='newdashboard-con'>
        
        ";
        // line 28
        echo "        
        
        
    </div>
    <div class='useradded-mem'>
        <div class=\"list\">
            <div class='members_bar shadow'>
                <div class='row'>
                    <div class='col-md-6 '>
                        <div class='user-img-section'>
                            <img src='sites/default/files/CODE.jpg' />
                            <a class=\"use-ajax\"
                            data-dialog-options=\"{&quot;width&quot;:400}\" 
                            data-dialog-type=\"modal\"
                            href=\"";
        // line 42
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->env->getExtension('Drupal\Core\Template\TwigExtension')->getPath("airchoice_member.dashboard_controller.member_info", ["user" => $this->getAttribute(($context["data"] ?? null), "user_id", [])]), "html", null, true);
        echo "\">
                            <h2>";
        // line 43
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute($this->getAttribute(($context["data"] ?? null), "user", []), "name", []), "value", [])), "html", null, true);
        echo " (Self) </h2>
                        </a>
                        
                        <div class='member_flights'>
                            <svg viewBox=\"0 0 18.854 17.941\"> <path d=\"M12.306,12.835,7.664,20.24c0,.052-.052.052-.1.052H5.735a.138.138,0,0,1-.157-.157l2.295-7.3H2.97L1.614,14.66c0,.052-.052.052-.1.052H.154A.138.138,0,0,1,0,14.556l.938-3.234L0,8.088a.167.167,0,0,1,.157-.157H1.51c.052,0,.1,0,.1.052L2.97,9.809h4.9l-2.295-7.3a.167.167,0,0,1,.157-.157H7.56c.052,0,.1,0,.1.052l4.641,7.406h5.059a1.513,1.513,0,0,1,0,3.025H12.306Z\" transform=\"translate(0.003 -2.352)\" fill=\"#411777\" fill-rule=\"evenodd\"></path></svg>
                        </div>
                    </div>
                </div>
                <div class='col-md-6 user-options'>
                    <div class='member_buttons'>
                        <a href='' class='member_view'>View Flights</a>
                        <a href='' class='member_activity'>View Activity</a>
                        <a href='/user/";
        // line 55
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute(($context["data"] ?? null), "user", []), "id", [])), "html", null, true);
        echo "/edit' class='member_edit'>Edit Profile</a>
                    </div>
                </div>
            </div>
            <!-- for user log section start  -->
            <div class=\"activity\">
                <h3>Most Recent Activity</h3>
                ";
        // line 62
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, views_embed_view("login", "block_1", $this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute(($context["data"] ?? null), "user", []), "id", []))), "html", null, true);
        echo "
            </div>
            <!--  for user log section end -->
            <!-- for user flight detail start -->
            <div class=\"members_flights_list\">
                <h3>Upcoming Flights</h3>
                <div class=\"row eq dashboard_content upcoming_flights_page\">
                    <div class=\"cm4 cs6\">
                        <div class=\"ticket ticket_white wbg\">
                            <h4>Ryan Covington</h4>
                            <div class=\"row\">
                                <div class=\"cxs4\">
                                    <div class=\"ticket_city_big\">STL</div>
                                    <div class=\"ticket_city_small\">St. Louis, MO</div>
                                </div>
                                <div class=\"cxs4\">
                                    <div class=\"ticket_depart_arrive\">Depart</div>
                                </div>
                                <div class=\"cxs4\">
                                    <div class=\"ticket_time\"><div class=\"ticket_time_big\">3:30</div><div class=\"ticket_am_pm\">pm</div></div>
                                    <div class=\"ticket_city_small\">St. Louis, MO</div>
                                </div>
                            </div>
                            
                            <div class=\"ticket_divider\"></div>
                            <div class=\"row rnp\">
                                <div class=\"cxs4\">
                                    <div class=\"ticket_city_big\">JKS</div>
                                    <div class=\"ticket_city_small\">Jackson, TN</div>
                                </div>
                                <div class=\"cxs4\">
                                    <div class=\"ticket_depart_arrive\">Arrive</div>
                                </div>
                                <div class=\"cxs4\">
                                    <div class=\"ticket_time\"><div class=\"ticket_time_big\">3:30</div><div class=\"ticket_am_pm\">pm</div></div>
                                    <div class=\"ticket_city_small\">St. Louis, MO</div>
                                </div>
                            </div>
                            
                            <div class=\"ticket_dash\"><svg height=\"1\" viewBox=\"0 0 385.908 1\">
                                  <line id=\"Line_104\" data-name=\"Line 104\" x2=\"384.908\" transform=\"translate(0.5 0.5)\" fill=\"none\" stroke=\"#ccc\" stroke-linecap=\"round\" stroke-width=\"1\" stroke-dasharray=\"0 3\"></line>
                                </svg>\t
                            </div>
                            
                            <div class=\"ticket_flight_time\">
                                <div class=\"ticket_ft_big\">3</div>
                                <div class=\"ticket_ft_sm\">hrs</div>
                                <div class=\"ticket_ft_big\">29</div>
                                <div class=\"ticket_ft_sm\">min</div>
                            </div>
                            
                            <div class=\"ticket_bottom_svg\">
                                <svg viewBox=\"0 0 188 24.631\">
                                      <line id=\"Line_53\" data-name=\"Line 53\" x2=\"187\" transform=\"translate(0.5 11.885)\" fill=\"none\" stroke=\"#9952f5\" stroke-linecap=\"round\" stroke-width=\"1\" stroke-dasharray=\"0 2\"></line>
                                      <path id=\"np_plane_2045803_000000\" d=\"M16.9,16.744,10.523,26.911c0,.072-.072.072-.143.072H7.874a.19.19,0,0,1-.215-.215l3.15-10.024H4.079L2.217,19.25c0,.072-.072.072-.143.072H.212A.19.19,0,0,1,0,19.107l1.288-4.439L0,10.228a.229.229,0,0,1,.215-.215H2.074c.072,0,.143,0,.143.072L4.079,12.59h6.73L7.659,2.567a.229.229,0,0,1,.215-.215H10.38c.072,0,.143,0,.143.072L16.9,12.59h6.945a2.077,2.077,0,0,1,0,4.153H16.9Z\" transform=\"translate(81.061 -2.352)\" fill=\"#7316ea\" fill-rule=\"evenodd\"></path>
                                    </svg>
                                    
                            </div>
                        </div>
                    </div>
                    <div class=\"cm4 cs6\">
                        <div class=\"ticket ticket_white wbg\">
                            <h4>Ryan Covington</h4>
                            <div class=\"row\">
                                <div class=\"cxs4\">
                                    <div class=\"ticket_city_big\">STL</div>
                                    <div class=\"ticket_city_small\">St. Louis, MO</div>
                                </div>
                                <div class=\"cxs4\">
                                    <div class=\"ticket_depart_arrive\">Depart</div>
                                </div>
                                <div class=\"cxs4\">
                                    <div class=\"ticket_time\"><div class=\"ticket_time_big\">3:30</div><div class=\"ticket_am_pm\">pm</div></div>
                                    <div class=\"ticket_city_small\">St. Louis, MO</div>
                                </div>
                            </div>
                            
                            <div class=\"ticket_divider\"></div>
                            <div class=\"row rnp\">
                                <div class=\"cxs4\">
                                    <div class=\"ticket_city_big\">JKS</div>
                                    <div class=\"ticket_city_small\">Jackson, TN</div>
                                </div>
                                <div class=\"cxs4\">
                                    <div class=\"ticket_depart_arrive\">Arrive</div>
                                </div>
                                <div class=\"cxs4\">
                                    <div class=\"ticket_time\"><div class=\"ticket_time_big\">3:30</div><div class=\"ticket_am_pm\">pm</div></div>
                                    <div class=\"ticket_city_small\">St. Louis, MO</div>
                                </div>
                            </div>
                            
                            <div class=\"ticket_dash\"><svg height=\"1\" viewBox=\"0 0 385.908 1\">
                                  <line id=\"Line_104\" data-name=\"Line 104\" x2=\"384.908\" transform=\"translate(0.5 0.5)\" fill=\"none\" stroke=\"#ccc\" stroke-linecap=\"round\" stroke-width=\"1\" stroke-dasharray=\"0 3\"></line>
                                </svg>\t
                            </div>
                            
                            <div class=\"ticket_flight_time\">
                                <div class=\"ticket_ft_big\">3</div>
                                <div class=\"ticket_ft_sm\">hrs</div>
                                <div class=\"ticket_ft_big\">29</div>
                                <div class=\"ticket_ft_sm\">min</div>
                            </div>
                            
                            <div class=\"ticket_bottom_svg\">
                                <svg viewBox=\"0 0 188 24.631\">
                                      <line id=\"Line_53\" data-name=\"Line 53\" x2=\"187\" transform=\"translate(0.5 11.885)\" fill=\"none\" stroke=\"#9952f5\" stroke-linecap=\"round\" stroke-width=\"1\" stroke-dasharray=\"0 2\"></line>
                                      <path id=\"np_plane_2045803_000000\" d=\"M16.9,16.744,10.523,26.911c0,.072-.072.072-.143.072H7.874a.19.19,0,0,1-.215-.215l3.15-10.024H4.079L2.217,19.25c0,.072-.072.072-.143.072H.212A.19.19,0,0,1,0,19.107l1.288-4.439L0,10.228a.229.229,0,0,1,.215-.215H2.074c.072,0,.143,0,.143.072L4.079,12.59h6.73L7.659,2.567a.229.229,0,0,1,.215-.215H10.38c.072,0,.143,0,.143.072L16.9,12.59h6.945a2.077,2.077,0,0,1,0,4.153H16.9Z\" transform=\"translate(81.061 -2.352)\" fill=\"#7316ea\" fill-rule=\"evenodd\"></path>
                                    </svg>
                                    
                            </div>
                        </div>
                    </div>
                    <div class=\"cm4 cs6\">
                        <div class=\"ticket ticket_white wbg\">
                            <h4>Ryan Covington</h4>
                            <div class=\"row\">
                                <div class=\"cxs4\">
                                    <div class=\"ticket_city_big\">STL</div>
                                    <div class=\"ticket_city_small\">St. Louis, MO</div>
                                </div>
                                <div class=\"cxs4\">
                                    <div class=\"ticket_depart_arrive\">Depart</div>
                                </div>
                                <div class=\"cxs4\">
                                    <div class=\"ticket_time\"><div class=\"ticket_time_big\">3:30</div><div class=\"ticket_am_pm\">pm</div></div>
                                    <div class=\"ticket_city_small\">St. Louis, MO</div>
                                </div>
                            </div>
                            
                            <div class=\"ticket_divider\"></div>
                            <div class=\"row rnp\">
                                <div class=\"cxs4\">
                                    <div class=\"ticket_city_big\">JKS</div>
                                    <div class=\"ticket_city_small\">Jackson, TN</div>
                                </div>
                                <div class=\"cxs4\">
                                    <div class=\"ticket_depart_arrive\">Arrive</div>
                                </div>
                                <div class=\"cxs4\">
                                    <div class=\"ticket_time\"><div class=\"ticket_time_big\">3:30</div><div class=\"ticket_am_pm\">pm</div></div>
                                    <div class=\"ticket_city_small\">St. Louis, MO</div>
                                </div>
                            </div>
                            
                            <div class=\"ticket_dash\"><svg height=\"1\" viewBox=\"0 0 385.908 1\">
                                  <line id=\"Line_104\" data-name=\"Line 104\" x2=\"384.908\" transform=\"translate(0.5 0.5)\" fill=\"none\" stroke=\"#ccc\" stroke-linecap=\"round\" stroke-width=\"1\" stroke-dasharray=\"0 3\"></line>
                                </svg>\t
                            </div>
                            
                            <div class=\"ticket_flight_time\">
                                <div class=\"ticket_ft_big\">3</div>
                                <div class=\"ticket_ft_sm\">hrs</div>
                                <div class=\"ticket_ft_big\">29</div>
                                <div class=\"ticket_ft_sm\">min</div>
                            </div>
                            
                            <div class=\"ticket_bottom_svg\">
                                <svg viewBox=\"0 0 188 24.631\">
                                      <line id=\"Line_53\" data-name=\"Line 53\" x2=\"187\" transform=\"translate(0.5 11.885)\" fill=\"none\" stroke=\"#9952f5\" stroke-linecap=\"round\" stroke-width=\"1\" stroke-dasharray=\"0 2\"></line>
                                      <path id=\"np_plane_2045803_000000\" d=\"M16.9,16.744,10.523,26.911c0,.072-.072.072-.143.072H7.874a.19.19,0,0,1-.215-.215l3.15-10.024H4.079L2.217,19.25c0,.072-.072.072-.143.072H.212A.19.19,0,0,1,0,19.107l1.288-4.439L0,10.228a.229.229,0,0,1,.215-.215H2.074c.072,0,.143,0,.143.072L4.079,12.59h6.73L7.659,2.567a.229.229,0,0,1,.215-.215H10.38c.072,0,.143,0,.143.072L16.9,12.59h6.945a2.077,2.077,0,0,1,0,4.153H16.9Z\" transform=\"translate(81.061 -2.352)\" fill=\"#7316ea\" fill-rule=\"evenodd\"></path>
                                    </svg>
                                    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- for user flight detail end  -->

        </div>
        ";
        // line 233
        if ((twig_length_filter($this->env, $this->getAttribute(($context["data"] ?? null), "members", [])) > 0)) {
            // line 234
            echo "
        ";
            // line 235
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["data"] ?? null), "members", []));
            foreach ($context['_seq'] as $context["_key"] => $context["member"]) {
                // line 236
                echo "        <div class='members_bar shadow'>
            <div class='row'>
                <div class='col-md-6 '>
                    <div class='user-img-section'>
                        <!-- <div class=\"alert alert-info\">
\t\t\t\t\t\t\t\tvariables in member
\t\t\t\t\t\t\t\t<pre>";
                // line 242
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, twig_var_dump($this->env, $context, [0 => $this->sandbox->ensureToStringAllowed($context["member"])]), "html", null, true);
                echo "</pre>
\t\t\t\t\t\t\t</div> -->
                        <img src='sites/default/files/CODE.jpg' />
                        <a class=\"use-ajax\"
                        data-dialog-options=\"{&quot;width&quot;:400}\"  
                        data-dialog-type=\"modal\"
                        href=\"";
                // line 248
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->env->getExtension('Drupal\Core\Template\TwigExtension')->getPath("airchoice_member.dashboard_controller.member_info", ["user" => $this->getAttribute($context["member"], "id", [])]), "html", null, true);
                echo "\"
                        >
                        <h2>";
                // line 250
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute($context["member"], "name", []), "value", [])), "html", null, true);
                echo "</h2>
                    </a>
                    <div class='member_flights'>
                        <svg viewBox=\"0 0 18.854 17.941\"> <path d=\"M12.306,12.835,7.664,20.24c0,.052-.052.052-.1.052H5.735a.138.138,0,0,1-.157-.157l2.295-7.3H2.97L1.614,14.66c0,.052-.052.052-.1.052H.154A.138.138,0,0,1,0,14.556l.938-3.234L0,8.088a.167.167,0,0,1,.157-.157H1.51c.052,0,.1,0,.1.052L2.97,9.809h4.9l-2.295-7.3a.167.167,0,0,1,.157-.157H7.56c.052,0,.1,0,.1.052l4.641,7.406h5.059a1.513,1.513,0,0,1,0,3.025H12.306Z\" transform=\"translate(0.003 -2.352)\" fill=\"#411777\" fill-rule=\"evenodd\"></path></svg>
                    </div>
                </div>
            </div>
            <div class='col-md-6 user-options'>
                <div class='member_buttons'>
                    <a href='' class='member_view'>View Flights</a>
                    <a href='' class='member_activity'>View Activity</a>
                    <a href='/user/";
                // line 261
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($context["member"], "id", [])), "html", null, true);
                echo "/edit' class='member_edit'>Edit Profile</a>
                </div>
            </div>
            
        </div>
                <!-- for user log section start  -->
                <div class=\"activity\">
                    <h3>Most Recent Activity</h3>
                    ";
                // line 269
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, views_embed_view("login", "block_1", $this->sandbox->ensureToStringAllowed($this->getAttribute($context["member"], "id", []))), "html", null, true);
                echo "
                </div>
                <!--  for user log section end -->
                <!-- for user flight detail start -->
                <div class=\"members_flights_list\">
                    <h3>Upcoming Flights</h3>
                    <div class=\"row eq dashboard_content upcoming_flights_page\">
                        <div class=\"cm4 cs6\">
                            <div class=\"ticket ticket_white wbg\">
                                <h4>Ryan Covington</h4>
                                <div class=\"row\">
                                    <div class=\"cxs4\">
                                        <div class=\"ticket_city_big\">STL</div>
                                        <div class=\"ticket_city_small\">St. Louis, MO</div>
                                    </div>
                                    <div class=\"cxs4\">
                                        <div class=\"ticket_depart_arrive\">Depart</div>
                                    </div>
                                    <div class=\"cxs4\">
                                        <div class=\"ticket_time\">
                                            <div class=\"ticket_time_big\">3:30</div>
                                            <div class=\"ticket_am_pm\">pm</div>
                                        </div>
                                        <div class=\"ticket_city_small\">St. Louis, MO</div>
                                    </div>
                                </div>

                                <div class=\"ticket_divider\"></div>
                                <div class=\"row rnp\">
                                    <div class=\"cxs4\">
                                        <div class=\"ticket_city_big\">JKS</div>
                                        <div class=\"ticket_city_small\">Jackson, TN</div>
                                    </div>
                                    <div class=\"cxs4\">
                                        <div class=\"ticket_depart_arrive\">Arrive</div>
                                    </div>
                                    <div class=\"cxs4\">
                                        <div class=\"ticket_time\">
                                            <div class=\"ticket_time_big\">3:30</div>
                                            <div class=\"ticket_am_pm\">pm</div>
                                        </div>
                                        <div class=\"ticket_city_small\">St. Louis, MO</div>
                                    </div>
                                </div>

                                <div class=\"ticket_dash\"><svg height=\"1\" viewBox=\"0 0 385.908 1\">
                                        <line id=\"Line_104\" data-name=\"Line 104\" x2=\"384.908\"
                                            transform=\"translate(0.5 0.5)\" fill=\"none\" stroke=\"#ccc\"
                                            stroke-linecap=\"round\" stroke-width=\"1\" stroke-dasharray=\"0 3\"></line>
                                    </svg>
                                </div>

                                <div class=\"ticket_flight_time\">
                                    <div class=\"ticket_ft_big\">3</div>
                                    <div class=\"ticket_ft_sm\">hrs</div>
                                    <div class=\"ticket_ft_big\">29</div>
                                    <div class=\"ticket_ft_sm\">min</div>
                                </div>

                                <div class=\"ticket_bottom_svg\">
                                    <svg viewBox=\"0 0 188 24.631\">
                                        <line id=\"Line_53\" data-name=\"Line 53\" x2=\"187\"
                                            transform=\"translate(0.5 11.885)\" fill=\"none\" stroke=\"#9952f5\"
                                            stroke-linecap=\"round\" stroke-width=\"1\" stroke-dasharray=\"0 2\"></line>
                                        <path id=\"np_plane_2045803_000000\"
                                            d=\"M16.9,16.744,10.523,26.911c0,.072-.072.072-.143.072H7.874a.19.19,0,0,1-.215-.215l3.15-10.024H4.079L2.217,19.25c0,.072-.072.072-.143.072H.212A.19.19,0,0,1,0,19.107l1.288-4.439L0,10.228a.229.229,0,0,1,.215-.215H2.074c.072,0,.143,0,.143.072L4.079,12.59h6.73L7.659,2.567a.229.229,0,0,1,.215-.215H10.38c.072,0,.143,0,.143.072L16.9,12.59h6.945a2.077,2.077,0,0,1,0,4.153H16.9Z\"
                                            transform=\"translate(81.061 -2.352)\" fill=\"#7316ea\" fill-rule=\"evenodd\">
                                        </path>
                                    </svg>

                                </div>
                            </div>
                        </div>
                        <div class=\"cm4 cs6\">
                            <div class=\"ticket ticket_white wbg\">
                                <h4>Ryan Covington</h4>
                                <div class=\"row\">
                                    <div class=\"cxs4\">
                                        <div class=\"ticket_city_big\">STL</div>
                                        <div class=\"ticket_city_small\">St. Louis, MO</div>
                                    </div>
                                    <div class=\"cxs4\">
                                        <div class=\"ticket_depart_arrive\">Depart</div>
                                    </div>
                                    <div class=\"cxs4\">
                                        <div class=\"ticket_time\">
                                            <div class=\"ticket_time_big\">3:30</div>
                                            <div class=\"ticket_am_pm\">pm</div>
                                        </div>
                                        <div class=\"ticket_city_small\">St. Louis, MO</div>
                                    </div>
                                </div>

                                <div class=\"ticket_divider\"></div>
                                <div class=\"row rnp\">
                                    <div class=\"cxs4\">
                                        <div class=\"ticket_city_big\">JKS</div>
                                        <div class=\"ticket_city_small\">Jackson, TN</div>
                                    </div>
                                    <div class=\"cxs4\">
                                        <div class=\"ticket_depart_arrive\">Arrive</div>
                                    </div>
                                    <div class=\"cxs4\">
                                        <div class=\"ticket_time\">
                                            <div class=\"ticket_time_big\">3:30</div>
                                            <div class=\"ticket_am_pm\">pm</div>
                                        </div>
                                        <div class=\"ticket_city_small\">St. Louis, MO</div>
                                    </div>
                                </div>

                                <div class=\"ticket_dash\"><svg height=\"1\" viewBox=\"0 0 385.908 1\">
                                        <line id=\"Line_104\" data-name=\"Line 104\" x2=\"384.908\"
                                            transform=\"translate(0.5 0.5)\" fill=\"none\" stroke=\"#ccc\"
                                            stroke-linecap=\"round\" stroke-width=\"1\" stroke-dasharray=\"0 3\"></line>
                                    </svg>
                                </div>

                                <div class=\"ticket_flight_time\">
                                    <div class=\"ticket_ft_big\">3</div>
                                    <div class=\"ticket_ft_sm\">hrs</div>
                                    <div class=\"ticket_ft_big\">29</div>
                                    <div class=\"ticket_ft_sm\">min</div>
                                </div>

                                <div class=\"ticket_bottom_svg\">
                                    <svg viewBox=\"0 0 188 24.631\">
                                        <line id=\"Line_53\" data-name=\"Line 53\" x2=\"187\"
                                            transform=\"translate(0.5 11.885)\" fill=\"none\" stroke=\"#9952f5\"
                                            stroke-linecap=\"round\" stroke-width=\"1\" stroke-dasharray=\"0 2\"></line>
                                        <path id=\"np_plane_2045803_000000\"
                                            d=\"M16.9,16.744,10.523,26.911c0,.072-.072.072-.143.072H7.874a.19.19,0,0,1-.215-.215l3.15-10.024H4.079L2.217,19.25c0,.072-.072.072-.143.072H.212A.19.19,0,0,1,0,19.107l1.288-4.439L0,10.228a.229.229,0,0,1,.215-.215H2.074c.072,0,.143,0,.143.072L4.079,12.59h6.73L7.659,2.567a.229.229,0,0,1,.215-.215H10.38c.072,0,.143,0,.143.072L16.9,12.59h6.945a2.077,2.077,0,0,1,0,4.153H16.9Z\"
                                            transform=\"translate(81.061 -2.352)\" fill=\"#7316ea\" fill-rule=\"evenodd\">
                                        </path>
                                    </svg>

                                </div>
                            </div>
                        </div>
                        <div class=\"cm4 cs6\">
                            <div class=\"ticket ticket_white wbg\">
                                <h4>Ryan Covington</h4>
                                <div class=\"row\">
                                    <div class=\"cxs4\">
                                        <div class=\"ticket_city_big\">STL</div>
                                        <div class=\"ticket_city_small\">St. Louis, MO</div>
                                    </div>
                                    <div class=\"cxs4\">
                                        <div class=\"ticket_depart_arrive\">Depart</div>
                                    </div>
                                    <div class=\"cxs4\">
                                        <div class=\"ticket_time\">
                                            <div class=\"ticket_time_big\">3:30</div>
                                            <div class=\"ticket_am_pm\">pm</div>
                                        </div>
                                        <div class=\"ticket_city_small\">St. Louis, MO</div>
                                    </div>
                                </div>

                                <div class=\"ticket_divider\"></div>
                                <div class=\"row rnp\">
                                    <div class=\"cxs4\">
                                        <div class=\"ticket_city_big\">JKS</div>
                                        <div class=\"ticket_city_small\">Jackson, TN</div>
                                    </div>
                                    <div class=\"cxs4\">
                                        <div class=\"ticket_depart_arrive\">Arrive</div>
                                    </div>
                                    <div class=\"cxs4\">
                                        <div class=\"ticket_time\">
                                            <div class=\"ticket_time_big\">3:30</div>
                                            <div class=\"ticket_am_pm\">pm</div>
                                        </div>
                                        <div class=\"ticket_city_small\">St. Louis, MO</div>
                                    </div>
                                </div>

                                <div class=\"ticket_dash\"><svg height=\"1\" viewBox=\"0 0 385.908 1\">
                                        <line id=\"Line_104\" data-name=\"Line 104\" x2=\"384.908\"
                                            transform=\"translate(0.5 0.5)\" fill=\"none\" stroke=\"#ccc\"
                                            stroke-linecap=\"round\" stroke-width=\"1\" stroke-dasharray=\"0 3\"></line>
                                    </svg>
                                </div>

                                <div class=\"ticket_flight_time\">
                                    <div class=\"ticket_ft_big\">3</div>
                                    <div class=\"ticket_ft_sm\">hrs</div>
                                    <div class=\"ticket_ft_big\">29</div>
                                    <div class=\"ticket_ft_sm\">min</div>
                                </div>

                                <div class=\"ticket_bottom_svg\">
                                    <svg viewBox=\"0 0 188 24.631\">
                                        <line id=\"Line_53\" data-name=\"Line 53\" x2=\"187\"
                                            transform=\"translate(0.5 11.885)\" fill=\"none\" stroke=\"#9952f5\"
                                            stroke-linecap=\"round\" stroke-width=\"1\" stroke-dasharray=\"0 2\"></line>
                                        <path id=\"np_plane_2045803_000000\"
                                            d=\"M16.9,16.744,10.523,26.911c0,.072-.072.072-.143.072H7.874a.19.19,0,0,1-.215-.215l3.15-10.024H4.079L2.217,19.25c0,.072-.072.072-.143.072H.212A.19.19,0,0,1,0,19.107l1.288-4.439L0,10.228a.229.229,0,0,1,.215-.215H2.074c.072,0,.143,0,.143.072L4.079,12.59h6.73L7.659,2.567a.229.229,0,0,1,.215-.215H10.38c.072,0,.143,0,.143.072L16.9,12.59h6.945a2.077,2.077,0,0,1,0,4.153H16.9Z\"
                                            transform=\"translate(81.061 -2.352)\" fill=\"#7316ea\" fill-rule=\"evenodd\">
                                        </path>
                                    </svg>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- for user flight detail end  -->
        
    </div>
    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['member'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 480
            echo "    ";
        } else {
            // line 481
            echo "    <div class=\"members_bar shadow alert alert-danger\"> No other members 😞 </div>
    ";
        }
        // line 483
        echo "</div>
</div>
</div>";
    }

    public function getTemplateName()
    {
        return "modules/custom/airchoice_member/templates/page-dashboard.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  590 => 483,  586 => 481,  583 => 480,  366 => 269,  355 => 261,  341 => 250,  336 => 248,  327 => 242,  319 => 236,  315 => 235,  312 => 234,  310 => 233,  136 => 62,  126 => 55,  111 => 43,  107 => 42,  91 => 28,  87 => 22,  83 => 19,  76 => 14,  68 => 9,  63 => 6,  61 => 5,  55 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source(" <div class='alert jumbotron members-addsection'>
    <div class='members-addsection-header'>  
        <div class='members-addsection-headerh1'><h1>Manage Members</h1></div>
        <div class='members-addmembers'>
            {% if data.canAddMoreMembers %}
            <a class=\"use-ajax btn btn-success\"
            data-dialog-options=\"{&quot;width&quot;:600}\"  
            data-dialog-type=\"modal\"
            href=\"{{ path('airchoice_member.add_member_form') }}\"><svg viewBox=\"0 0 100 100\"><g>
\t\t\t\t\t\t  <path d=\"m25 46.43h-0.050781c-1.9727 0-3.5703 1.5977-3.5703 3.5703 0 1.9766 1.5977 3.5703 3.5703 3.5703h0.054687 49.992 0.050781c1.9727 0 3.5703-1.5977 3.5703-3.5703 0-1.9766-1.5977-3.5703-3.5703-3.5703h-0.054687z\"></path>
\t\t\t\t\t\t  <path d=\"m53.57 25v-0.050781c0-1.9727-1.5977-3.5703-3.5703-3.5703-1.9766 0-3.5703 1.5977-3.5703 3.5703v0.054687-0.003906 49.996 0.050781c0 1.9727 1.5977 3.5703 3.5703 3.5703 1.9766 0 3.5703-1.5977 3.5703-3.5703v-0.054687 0.003906z\"></path>
\t\t\t\t\t\t  <path d=\"m50 0c-27.57 0-49.996 22.43-49.996 49.996 0 27.57 22.43 49.996 49.996 49.996 27.57 0 49.996-22.43 49.996-49.996 0-27.57-22.43-49.996-49.996-49.996zm0 7.1445c23.711 0 42.855 19.148 42.855 42.855 0 23.711-19.145 42.855-42.855 42.855s-42.855-19.145-42.855-42.855 19.145-42.855 42.855-42.855z\"></path></g></svg>Add New Member</a>
            {% else %}
            <a class=\"btn btn-success\" href=\"javascript:void(0)\" disabled><svg viewBox=\"0 0 100 100\"><g>
\t\t\t\t\t\t  <path d=\"m25 46.43h-0.050781c-1.9727 0-3.5703 1.5977-3.5703 3.5703 0 1.9766 1.5977 3.5703 3.5703 3.5703h0.054687 49.992 0.050781c1.9727 0 3.5703-1.5977 3.5703-3.5703 0-1.9766-1.5977-3.5703-3.5703-3.5703h-0.054687z\"></path>
\t\t\t\t\t\t  <path d=\"m53.57 25v-0.050781c0-1.9727-1.5977-3.5703-3.5703-3.5703-1.9766 0-3.5703 1.5977-3.5703 3.5703v0.054687-0.003906 49.996 0.050781c0 1.9727 1.5977 3.5703 3.5703 3.5703 1.9766 0 3.5703-1.5977 3.5703-3.5703v-0.054687 0.003906z\"></path>
\t\t\t\t\t\t  <path d=\"m50 0c-27.57 0-49.996 22.43-49.996 49.996 0 27.57 22.43 49.996 49.996 49.996 27.57 0 49.996-22.43 49.996-49.996 0-27.57-22.43-49.996-49.996-49.996zm0 7.1445c23.711 0 42.855 19.148 42.855 42.855 0 23.711-19.145 42.855-42.855 42.855s-42.855-19.145-42.855-42.855 19.145-42.855 42.855-42.855z\"></path></g></svg>Add New Member ☹️ </a>
            {% endif %}
        </div>
    </div>
       {# /* {{ drupal_entity(\"user\", data.user_id, \"default\") }} */    #}
    <div class='newdashboard-con'>
        
        {# {{ drupal_entity(\"profile\", data.profile_id, \"full\") }}
        
        {{ drupal_entity(\"node\", data.package_id, \"full\") }}
        <h3>Members</h3> #}
        
        
        
    </div>
    <div class='useradded-mem'>
        <div class=\"list\">
            <div class='members_bar shadow'>
                <div class='row'>
                    <div class='col-md-6 '>
                        <div class='user-img-section'>
                            <img src='sites/default/files/CODE.jpg' />
                            <a class=\"use-ajax\"
                            data-dialog-options=\"{&quot;width&quot;:400}\" 
                            data-dialog-type=\"modal\"
                            href=\"{{ path('airchoice_member.dashboard_controller.member_info', {user: data.user_id}) }}\">
                            <h2>{{ data.user.name.value }} (Self) </h2>
                        </a>
                        
                        <div class='member_flights'>
                            <svg viewBox=\"0 0 18.854 17.941\"> <path d=\"M12.306,12.835,7.664,20.24c0,.052-.052.052-.1.052H5.735a.138.138,0,0,1-.157-.157l2.295-7.3H2.97L1.614,14.66c0,.052-.052.052-.1.052H.154A.138.138,0,0,1,0,14.556l.938-3.234L0,8.088a.167.167,0,0,1,.157-.157H1.51c.052,0,.1,0,.1.052L2.97,9.809h4.9l-2.295-7.3a.167.167,0,0,1,.157-.157H7.56c.052,0,.1,0,.1.052l4.641,7.406h5.059a1.513,1.513,0,0,1,0,3.025H12.306Z\" transform=\"translate(0.003 -2.352)\" fill=\"#411777\" fill-rule=\"evenodd\"></path></svg>
                        </div>
                    </div>
                </div>
                <div class='col-md-6 user-options'>
                    <div class='member_buttons'>
                        <a href='' class='member_view'>View Flights</a>
                        <a href='' class='member_activity'>View Activity</a>
                        <a href='/user/{{data.user.id}}/edit' class='member_edit'>Edit Profile</a>
                    </div>
                </div>
            </div>
            <!-- for user log section start  -->
            <div class=\"activity\">
                <h3>Most Recent Activity</h3>
                {{ drupal_view('login', 'block_1', data.user.id) }}
            </div>
            <!--  for user log section end -->
            <!-- for user flight detail start -->
            <div class=\"members_flights_list\">
                <h3>Upcoming Flights</h3>
                <div class=\"row eq dashboard_content upcoming_flights_page\">
                    <div class=\"cm4 cs6\">
                        <div class=\"ticket ticket_white wbg\">
                            <h4>Ryan Covington</h4>
                            <div class=\"row\">
                                <div class=\"cxs4\">
                                    <div class=\"ticket_city_big\">STL</div>
                                    <div class=\"ticket_city_small\">St. Louis, MO</div>
                                </div>
                                <div class=\"cxs4\">
                                    <div class=\"ticket_depart_arrive\">Depart</div>
                                </div>
                                <div class=\"cxs4\">
                                    <div class=\"ticket_time\"><div class=\"ticket_time_big\">3:30</div><div class=\"ticket_am_pm\">pm</div></div>
                                    <div class=\"ticket_city_small\">St. Louis, MO</div>
                                </div>
                            </div>
                            
                            <div class=\"ticket_divider\"></div>
                            <div class=\"row rnp\">
                                <div class=\"cxs4\">
                                    <div class=\"ticket_city_big\">JKS</div>
                                    <div class=\"ticket_city_small\">Jackson, TN</div>
                                </div>
                                <div class=\"cxs4\">
                                    <div class=\"ticket_depart_arrive\">Arrive</div>
                                </div>
                                <div class=\"cxs4\">
                                    <div class=\"ticket_time\"><div class=\"ticket_time_big\">3:30</div><div class=\"ticket_am_pm\">pm</div></div>
                                    <div class=\"ticket_city_small\">St. Louis, MO</div>
                                </div>
                            </div>
                            
                            <div class=\"ticket_dash\"><svg height=\"1\" viewBox=\"0 0 385.908 1\">
                                  <line id=\"Line_104\" data-name=\"Line 104\" x2=\"384.908\" transform=\"translate(0.5 0.5)\" fill=\"none\" stroke=\"#ccc\" stroke-linecap=\"round\" stroke-width=\"1\" stroke-dasharray=\"0 3\"></line>
                                </svg>\t
                            </div>
                            
                            <div class=\"ticket_flight_time\">
                                <div class=\"ticket_ft_big\">3</div>
                                <div class=\"ticket_ft_sm\">hrs</div>
                                <div class=\"ticket_ft_big\">29</div>
                                <div class=\"ticket_ft_sm\">min</div>
                            </div>
                            
                            <div class=\"ticket_bottom_svg\">
                                <svg viewBox=\"0 0 188 24.631\">
                                      <line id=\"Line_53\" data-name=\"Line 53\" x2=\"187\" transform=\"translate(0.5 11.885)\" fill=\"none\" stroke=\"#9952f5\" stroke-linecap=\"round\" stroke-width=\"1\" stroke-dasharray=\"0 2\"></line>
                                      <path id=\"np_plane_2045803_000000\" d=\"M16.9,16.744,10.523,26.911c0,.072-.072.072-.143.072H7.874a.19.19,0,0,1-.215-.215l3.15-10.024H4.079L2.217,19.25c0,.072-.072.072-.143.072H.212A.19.19,0,0,1,0,19.107l1.288-4.439L0,10.228a.229.229,0,0,1,.215-.215H2.074c.072,0,.143,0,.143.072L4.079,12.59h6.73L7.659,2.567a.229.229,0,0,1,.215-.215H10.38c.072,0,.143,0,.143.072L16.9,12.59h6.945a2.077,2.077,0,0,1,0,4.153H16.9Z\" transform=\"translate(81.061 -2.352)\" fill=\"#7316ea\" fill-rule=\"evenodd\"></path>
                                    </svg>
                                    
                            </div>
                        </div>
                    </div>
                    <div class=\"cm4 cs6\">
                        <div class=\"ticket ticket_white wbg\">
                            <h4>Ryan Covington</h4>
                            <div class=\"row\">
                                <div class=\"cxs4\">
                                    <div class=\"ticket_city_big\">STL</div>
                                    <div class=\"ticket_city_small\">St. Louis, MO</div>
                                </div>
                                <div class=\"cxs4\">
                                    <div class=\"ticket_depart_arrive\">Depart</div>
                                </div>
                                <div class=\"cxs4\">
                                    <div class=\"ticket_time\"><div class=\"ticket_time_big\">3:30</div><div class=\"ticket_am_pm\">pm</div></div>
                                    <div class=\"ticket_city_small\">St. Louis, MO</div>
                                </div>
                            </div>
                            
                            <div class=\"ticket_divider\"></div>
                            <div class=\"row rnp\">
                                <div class=\"cxs4\">
                                    <div class=\"ticket_city_big\">JKS</div>
                                    <div class=\"ticket_city_small\">Jackson, TN</div>
                                </div>
                                <div class=\"cxs4\">
                                    <div class=\"ticket_depart_arrive\">Arrive</div>
                                </div>
                                <div class=\"cxs4\">
                                    <div class=\"ticket_time\"><div class=\"ticket_time_big\">3:30</div><div class=\"ticket_am_pm\">pm</div></div>
                                    <div class=\"ticket_city_small\">St. Louis, MO</div>
                                </div>
                            </div>
                            
                            <div class=\"ticket_dash\"><svg height=\"1\" viewBox=\"0 0 385.908 1\">
                                  <line id=\"Line_104\" data-name=\"Line 104\" x2=\"384.908\" transform=\"translate(0.5 0.5)\" fill=\"none\" stroke=\"#ccc\" stroke-linecap=\"round\" stroke-width=\"1\" stroke-dasharray=\"0 3\"></line>
                                </svg>\t
                            </div>
                            
                            <div class=\"ticket_flight_time\">
                                <div class=\"ticket_ft_big\">3</div>
                                <div class=\"ticket_ft_sm\">hrs</div>
                                <div class=\"ticket_ft_big\">29</div>
                                <div class=\"ticket_ft_sm\">min</div>
                            </div>
                            
                            <div class=\"ticket_bottom_svg\">
                                <svg viewBox=\"0 0 188 24.631\">
                                      <line id=\"Line_53\" data-name=\"Line 53\" x2=\"187\" transform=\"translate(0.5 11.885)\" fill=\"none\" stroke=\"#9952f5\" stroke-linecap=\"round\" stroke-width=\"1\" stroke-dasharray=\"0 2\"></line>
                                      <path id=\"np_plane_2045803_000000\" d=\"M16.9,16.744,10.523,26.911c0,.072-.072.072-.143.072H7.874a.19.19,0,0,1-.215-.215l3.15-10.024H4.079L2.217,19.25c0,.072-.072.072-.143.072H.212A.19.19,0,0,1,0,19.107l1.288-4.439L0,10.228a.229.229,0,0,1,.215-.215H2.074c.072,0,.143,0,.143.072L4.079,12.59h6.73L7.659,2.567a.229.229,0,0,1,.215-.215H10.38c.072,0,.143,0,.143.072L16.9,12.59h6.945a2.077,2.077,0,0,1,0,4.153H16.9Z\" transform=\"translate(81.061 -2.352)\" fill=\"#7316ea\" fill-rule=\"evenodd\"></path>
                                    </svg>
                                    
                            </div>
                        </div>
                    </div>
                    <div class=\"cm4 cs6\">
                        <div class=\"ticket ticket_white wbg\">
                            <h4>Ryan Covington</h4>
                            <div class=\"row\">
                                <div class=\"cxs4\">
                                    <div class=\"ticket_city_big\">STL</div>
                                    <div class=\"ticket_city_small\">St. Louis, MO</div>
                                </div>
                                <div class=\"cxs4\">
                                    <div class=\"ticket_depart_arrive\">Depart</div>
                                </div>
                                <div class=\"cxs4\">
                                    <div class=\"ticket_time\"><div class=\"ticket_time_big\">3:30</div><div class=\"ticket_am_pm\">pm</div></div>
                                    <div class=\"ticket_city_small\">St. Louis, MO</div>
                                </div>
                            </div>
                            
                            <div class=\"ticket_divider\"></div>
                            <div class=\"row rnp\">
                                <div class=\"cxs4\">
                                    <div class=\"ticket_city_big\">JKS</div>
                                    <div class=\"ticket_city_small\">Jackson, TN</div>
                                </div>
                                <div class=\"cxs4\">
                                    <div class=\"ticket_depart_arrive\">Arrive</div>
                                </div>
                                <div class=\"cxs4\">
                                    <div class=\"ticket_time\"><div class=\"ticket_time_big\">3:30</div><div class=\"ticket_am_pm\">pm</div></div>
                                    <div class=\"ticket_city_small\">St. Louis, MO</div>
                                </div>
                            </div>
                            
                            <div class=\"ticket_dash\"><svg height=\"1\" viewBox=\"0 0 385.908 1\">
                                  <line id=\"Line_104\" data-name=\"Line 104\" x2=\"384.908\" transform=\"translate(0.5 0.5)\" fill=\"none\" stroke=\"#ccc\" stroke-linecap=\"round\" stroke-width=\"1\" stroke-dasharray=\"0 3\"></line>
                                </svg>\t
                            </div>
                            
                            <div class=\"ticket_flight_time\">
                                <div class=\"ticket_ft_big\">3</div>
                                <div class=\"ticket_ft_sm\">hrs</div>
                                <div class=\"ticket_ft_big\">29</div>
                                <div class=\"ticket_ft_sm\">min</div>
                            </div>
                            
                            <div class=\"ticket_bottom_svg\">
                                <svg viewBox=\"0 0 188 24.631\">
                                      <line id=\"Line_53\" data-name=\"Line 53\" x2=\"187\" transform=\"translate(0.5 11.885)\" fill=\"none\" stroke=\"#9952f5\" stroke-linecap=\"round\" stroke-width=\"1\" stroke-dasharray=\"0 2\"></line>
                                      <path id=\"np_plane_2045803_000000\" d=\"M16.9,16.744,10.523,26.911c0,.072-.072.072-.143.072H7.874a.19.19,0,0,1-.215-.215l3.15-10.024H4.079L2.217,19.25c0,.072-.072.072-.143.072H.212A.19.19,0,0,1,0,19.107l1.288-4.439L0,10.228a.229.229,0,0,1,.215-.215H2.074c.072,0,.143,0,.143.072L4.079,12.59h6.73L7.659,2.567a.229.229,0,0,1,.215-.215H10.38c.072,0,.143,0,.143.072L16.9,12.59h6.945a2.077,2.077,0,0,1,0,4.153H16.9Z\" transform=\"translate(81.061 -2.352)\" fill=\"#7316ea\" fill-rule=\"evenodd\"></path>
                                    </svg>
                                    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- for user flight detail end  -->

        </div>
        {% if  data.members|length > 0 %}

        {% for member in data.members %}
        <div class='members_bar shadow'>
            <div class='row'>
                <div class='col-md-6 '>
                    <div class='user-img-section'>
                        <!-- <div class=\"alert alert-info\">
\t\t\t\t\t\t\t\tvariables in member
\t\t\t\t\t\t\t\t<pre>{{ dump(member) }}</pre>
\t\t\t\t\t\t\t</div> -->
                        <img src='sites/default/files/CODE.jpg' />
                        <a class=\"use-ajax\"
                        data-dialog-options=\"{&quot;width&quot;:400}\"  
                        data-dialog-type=\"modal\"
                        href=\"{{ path('airchoice_member.dashboard_controller.member_info', {user:member.id}) }}\"
                        >
                        <h2>{{member.name.value}}</h2>
                    </a>
                    <div class='member_flights'>
                        <svg viewBox=\"0 0 18.854 17.941\"> <path d=\"M12.306,12.835,7.664,20.24c0,.052-.052.052-.1.052H5.735a.138.138,0,0,1-.157-.157l2.295-7.3H2.97L1.614,14.66c0,.052-.052.052-.1.052H.154A.138.138,0,0,1,0,14.556l.938-3.234L0,8.088a.167.167,0,0,1,.157-.157H1.51c.052,0,.1,0,.1.052L2.97,9.809h4.9l-2.295-7.3a.167.167,0,0,1,.157-.157H7.56c.052,0,.1,0,.1.052l4.641,7.406h5.059a1.513,1.513,0,0,1,0,3.025H12.306Z\" transform=\"translate(0.003 -2.352)\" fill=\"#411777\" fill-rule=\"evenodd\"></path></svg>
                    </div>
                </div>
            </div>
            <div class='col-md-6 user-options'>
                <div class='member_buttons'>
                    <a href='' class='member_view'>View Flights</a>
                    <a href='' class='member_activity'>View Activity</a>
                    <a href='/user/{{member.id}}/edit' class='member_edit'>Edit Profile</a>
                </div>
            </div>
            
        </div>
                <!-- for user log section start  -->
                <div class=\"activity\">
                    <h3>Most Recent Activity</h3>
                    {{ drupal_view('login', 'block_1', member.id) }}
                </div>
                <!--  for user log section end -->
                <!-- for user flight detail start -->
                <div class=\"members_flights_list\">
                    <h3>Upcoming Flights</h3>
                    <div class=\"row eq dashboard_content upcoming_flights_page\">
                        <div class=\"cm4 cs6\">
                            <div class=\"ticket ticket_white wbg\">
                                <h4>Ryan Covington</h4>
                                <div class=\"row\">
                                    <div class=\"cxs4\">
                                        <div class=\"ticket_city_big\">STL</div>
                                        <div class=\"ticket_city_small\">St. Louis, MO</div>
                                    </div>
                                    <div class=\"cxs4\">
                                        <div class=\"ticket_depart_arrive\">Depart</div>
                                    </div>
                                    <div class=\"cxs4\">
                                        <div class=\"ticket_time\">
                                            <div class=\"ticket_time_big\">3:30</div>
                                            <div class=\"ticket_am_pm\">pm</div>
                                        </div>
                                        <div class=\"ticket_city_small\">St. Louis, MO</div>
                                    </div>
                                </div>

                                <div class=\"ticket_divider\"></div>
                                <div class=\"row rnp\">
                                    <div class=\"cxs4\">
                                        <div class=\"ticket_city_big\">JKS</div>
                                        <div class=\"ticket_city_small\">Jackson, TN</div>
                                    </div>
                                    <div class=\"cxs4\">
                                        <div class=\"ticket_depart_arrive\">Arrive</div>
                                    </div>
                                    <div class=\"cxs4\">
                                        <div class=\"ticket_time\">
                                            <div class=\"ticket_time_big\">3:30</div>
                                            <div class=\"ticket_am_pm\">pm</div>
                                        </div>
                                        <div class=\"ticket_city_small\">St. Louis, MO</div>
                                    </div>
                                </div>

                                <div class=\"ticket_dash\"><svg height=\"1\" viewBox=\"0 0 385.908 1\">
                                        <line id=\"Line_104\" data-name=\"Line 104\" x2=\"384.908\"
                                            transform=\"translate(0.5 0.5)\" fill=\"none\" stroke=\"#ccc\"
                                            stroke-linecap=\"round\" stroke-width=\"1\" stroke-dasharray=\"0 3\"></line>
                                    </svg>
                                </div>

                                <div class=\"ticket_flight_time\">
                                    <div class=\"ticket_ft_big\">3</div>
                                    <div class=\"ticket_ft_sm\">hrs</div>
                                    <div class=\"ticket_ft_big\">29</div>
                                    <div class=\"ticket_ft_sm\">min</div>
                                </div>

                                <div class=\"ticket_bottom_svg\">
                                    <svg viewBox=\"0 0 188 24.631\">
                                        <line id=\"Line_53\" data-name=\"Line 53\" x2=\"187\"
                                            transform=\"translate(0.5 11.885)\" fill=\"none\" stroke=\"#9952f5\"
                                            stroke-linecap=\"round\" stroke-width=\"1\" stroke-dasharray=\"0 2\"></line>
                                        <path id=\"np_plane_2045803_000000\"
                                            d=\"M16.9,16.744,10.523,26.911c0,.072-.072.072-.143.072H7.874a.19.19,0,0,1-.215-.215l3.15-10.024H4.079L2.217,19.25c0,.072-.072.072-.143.072H.212A.19.19,0,0,1,0,19.107l1.288-4.439L0,10.228a.229.229,0,0,1,.215-.215H2.074c.072,0,.143,0,.143.072L4.079,12.59h6.73L7.659,2.567a.229.229,0,0,1,.215-.215H10.38c.072,0,.143,0,.143.072L16.9,12.59h6.945a2.077,2.077,0,0,1,0,4.153H16.9Z\"
                                            transform=\"translate(81.061 -2.352)\" fill=\"#7316ea\" fill-rule=\"evenodd\">
                                        </path>
                                    </svg>

                                </div>
                            </div>
                        </div>
                        <div class=\"cm4 cs6\">
                            <div class=\"ticket ticket_white wbg\">
                                <h4>Ryan Covington</h4>
                                <div class=\"row\">
                                    <div class=\"cxs4\">
                                        <div class=\"ticket_city_big\">STL</div>
                                        <div class=\"ticket_city_small\">St. Louis, MO</div>
                                    </div>
                                    <div class=\"cxs4\">
                                        <div class=\"ticket_depart_arrive\">Depart</div>
                                    </div>
                                    <div class=\"cxs4\">
                                        <div class=\"ticket_time\">
                                            <div class=\"ticket_time_big\">3:30</div>
                                            <div class=\"ticket_am_pm\">pm</div>
                                        </div>
                                        <div class=\"ticket_city_small\">St. Louis, MO</div>
                                    </div>
                                </div>

                                <div class=\"ticket_divider\"></div>
                                <div class=\"row rnp\">
                                    <div class=\"cxs4\">
                                        <div class=\"ticket_city_big\">JKS</div>
                                        <div class=\"ticket_city_small\">Jackson, TN</div>
                                    </div>
                                    <div class=\"cxs4\">
                                        <div class=\"ticket_depart_arrive\">Arrive</div>
                                    </div>
                                    <div class=\"cxs4\">
                                        <div class=\"ticket_time\">
                                            <div class=\"ticket_time_big\">3:30</div>
                                            <div class=\"ticket_am_pm\">pm</div>
                                        </div>
                                        <div class=\"ticket_city_small\">St. Louis, MO</div>
                                    </div>
                                </div>

                                <div class=\"ticket_dash\"><svg height=\"1\" viewBox=\"0 0 385.908 1\">
                                        <line id=\"Line_104\" data-name=\"Line 104\" x2=\"384.908\"
                                            transform=\"translate(0.5 0.5)\" fill=\"none\" stroke=\"#ccc\"
                                            stroke-linecap=\"round\" stroke-width=\"1\" stroke-dasharray=\"0 3\"></line>
                                    </svg>
                                </div>

                                <div class=\"ticket_flight_time\">
                                    <div class=\"ticket_ft_big\">3</div>
                                    <div class=\"ticket_ft_sm\">hrs</div>
                                    <div class=\"ticket_ft_big\">29</div>
                                    <div class=\"ticket_ft_sm\">min</div>
                                </div>

                                <div class=\"ticket_bottom_svg\">
                                    <svg viewBox=\"0 0 188 24.631\">
                                        <line id=\"Line_53\" data-name=\"Line 53\" x2=\"187\"
                                            transform=\"translate(0.5 11.885)\" fill=\"none\" stroke=\"#9952f5\"
                                            stroke-linecap=\"round\" stroke-width=\"1\" stroke-dasharray=\"0 2\"></line>
                                        <path id=\"np_plane_2045803_000000\"
                                            d=\"M16.9,16.744,10.523,26.911c0,.072-.072.072-.143.072H7.874a.19.19,0,0,1-.215-.215l3.15-10.024H4.079L2.217,19.25c0,.072-.072.072-.143.072H.212A.19.19,0,0,1,0,19.107l1.288-4.439L0,10.228a.229.229,0,0,1,.215-.215H2.074c.072,0,.143,0,.143.072L4.079,12.59h6.73L7.659,2.567a.229.229,0,0,1,.215-.215H10.38c.072,0,.143,0,.143.072L16.9,12.59h6.945a2.077,2.077,0,0,1,0,4.153H16.9Z\"
                                            transform=\"translate(81.061 -2.352)\" fill=\"#7316ea\" fill-rule=\"evenodd\">
                                        </path>
                                    </svg>

                                </div>
                            </div>
                        </div>
                        <div class=\"cm4 cs6\">
                            <div class=\"ticket ticket_white wbg\">
                                <h4>Ryan Covington</h4>
                                <div class=\"row\">
                                    <div class=\"cxs4\">
                                        <div class=\"ticket_city_big\">STL</div>
                                        <div class=\"ticket_city_small\">St. Louis, MO</div>
                                    </div>
                                    <div class=\"cxs4\">
                                        <div class=\"ticket_depart_arrive\">Depart</div>
                                    </div>
                                    <div class=\"cxs4\">
                                        <div class=\"ticket_time\">
                                            <div class=\"ticket_time_big\">3:30</div>
                                            <div class=\"ticket_am_pm\">pm</div>
                                        </div>
                                        <div class=\"ticket_city_small\">St. Louis, MO</div>
                                    </div>
                                </div>

                                <div class=\"ticket_divider\"></div>
                                <div class=\"row rnp\">
                                    <div class=\"cxs4\">
                                        <div class=\"ticket_city_big\">JKS</div>
                                        <div class=\"ticket_city_small\">Jackson, TN</div>
                                    </div>
                                    <div class=\"cxs4\">
                                        <div class=\"ticket_depart_arrive\">Arrive</div>
                                    </div>
                                    <div class=\"cxs4\">
                                        <div class=\"ticket_time\">
                                            <div class=\"ticket_time_big\">3:30</div>
                                            <div class=\"ticket_am_pm\">pm</div>
                                        </div>
                                        <div class=\"ticket_city_small\">St. Louis, MO</div>
                                    </div>
                                </div>

                                <div class=\"ticket_dash\"><svg height=\"1\" viewBox=\"0 0 385.908 1\">
                                        <line id=\"Line_104\" data-name=\"Line 104\" x2=\"384.908\"
                                            transform=\"translate(0.5 0.5)\" fill=\"none\" stroke=\"#ccc\"
                                            stroke-linecap=\"round\" stroke-width=\"1\" stroke-dasharray=\"0 3\"></line>
                                    </svg>
                                </div>

                                <div class=\"ticket_flight_time\">
                                    <div class=\"ticket_ft_big\">3</div>
                                    <div class=\"ticket_ft_sm\">hrs</div>
                                    <div class=\"ticket_ft_big\">29</div>
                                    <div class=\"ticket_ft_sm\">min</div>
                                </div>

                                <div class=\"ticket_bottom_svg\">
                                    <svg viewBox=\"0 0 188 24.631\">
                                        <line id=\"Line_53\" data-name=\"Line 53\" x2=\"187\"
                                            transform=\"translate(0.5 11.885)\" fill=\"none\" stroke=\"#9952f5\"
                                            stroke-linecap=\"round\" stroke-width=\"1\" stroke-dasharray=\"0 2\"></line>
                                        <path id=\"np_plane_2045803_000000\"
                                            d=\"M16.9,16.744,10.523,26.911c0,.072-.072.072-.143.072H7.874a.19.19,0,0,1-.215-.215l3.15-10.024H4.079L2.217,19.25c0,.072-.072.072-.143.072H.212A.19.19,0,0,1,0,19.107l1.288-4.439L0,10.228a.229.229,0,0,1,.215-.215H2.074c.072,0,.143,0,.143.072L4.079,12.59h6.73L7.659,2.567a.229.229,0,0,1,.215-.215H10.38c.072,0,.143,0,.143.072L16.9,12.59h6.945a2.077,2.077,0,0,1,0,4.153H16.9Z\"
                                            transform=\"translate(81.061 -2.352)\" fill=\"#7316ea\" fill-rule=\"evenodd\">
                                        </path>
                                    </svg>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- for user flight detail end  -->
        
    </div>
    {% endfor %}
    {% else %}
    <div class=\"members_bar shadow alert alert-danger\"> No other members 😞 </div>
    {% endif %}
</div>
</div>
</div>", "modules/custom/airchoice_member/templates/page-dashboard.html.twig", "/var/www/aironem/public_html/modules/custom/airchoice_member/templates/page-dashboard.html.twig");
    }
}
