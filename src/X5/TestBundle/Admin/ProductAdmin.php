<?php
namespace X5\TestBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;

use Knp\Menu\ItemInterface as MenuItemInterface;

class ProductAdmin extends Admin
{
    /**
     * Конфигурация отображения записи
     *
     * @param \Sonata\AdminBundle\Show\ShowMapper $showMapper
     * @return void
     */
    protected function configureShowField(ShowMapper $showMapper)
    {
        $showMapper
                ->add('id', null, array('label' => 'Идентификатор'))
                ->add('title', null, array('label' => 'Заголовок'))
                ->add('description', null, array('label' => 'Описание'))
                ->add('price', null, array('label' => 'Цена'))
                ->add('productCategory', null, array('label' => 'Категория продуктов'));
    }

    /**
     * Конфигурация формы редактирования записи
     * @param \Sonata\AdminBundle\Form\FormMapper $formMapper
     * @return void
     */
    protected function configureFormFields(FormMapper $formMapper)
    { 
    	$date = new \DateTime('now');
        $formMapper
                ->add('title', null, array('label' => 'Заголовок'))
                ->add('description', null, array('label' => 'Описание'))
                ->add('price', null, array('label' => 'Цена'))
                ->add('isDelete','hidden', array('label' => 'статус', 'data' =>'0'))
                ->add('created_date','date', array('label' => 'дата', 'data' =>$date))
                ->add('productCategory', null, array('label' => 'Категория продуктов'))
                ->setHelps(array(
                                'title' => 'Подсказка по заголовку'
                               
                           ));
    }

    /**
     * Конфигурация списка записей
     *
     * @param \Sonata\AdminBundle\Datagrid\ListMapper $listMapper
     * @return void
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
                ->addIdentifier('id')
                ->addIdentifier('title', null, array('label' => 'Заголовок'))
                ->add('price', null, array('label' => 'Цена'))
                ->add('isDelete', 'hidden', array('label' => 'статус', 'data'=>'0'))
                ->add('productCategory', null, array('label' => 'Категория продуктов'));
    }

    /**
     * Поля, по которым производится поиск в списке записей
     *
     * @param \Sonata\AdminBundle\Datagrid\DatagridMapper $datagridMapper
     * @return void
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
                ->add('title', null, array('label' => 'Заголовок'));
    }

    /**
     * Конфигурация левого меню при отображении и редатировании записи
     *
     * @param \Knp\Menu\ItemInterface $menu
     * @param $action
     * @param null|\Sonata\AdminBundle\Admin\Admin $childAdmin
     *
     * @return void
     */
    protected function configureSideMenu(MenuItemInterface $menu, $action, AdminInterface $childAdmin = null)
    {

         if (!in_array($action, array('edit', 'show'))) {
            return;
        }
        $admin = $this->isChild() ? $this->getParent() : $this;
        $id = $this->getRequest()->get('id');
        $menu->addChild(
            $this->trans('sidemenu.link_edit_media'),
            array('uri' => $admin->generateUrl('edit', array('id' => $id)))
        );
        $menu->addChild(
            $this->trans('sidemenu.link_media_view'),
            array('uri' => $admin->generateUrl('show', array('id' => $id)))
        );
    }
}