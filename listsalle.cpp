#include "listsalle.h"
#include <QStandardItemModel>
#include <QSqlQuery>
#include "database.h"

ListSalle::ListSalle(COAC *parentFenetre, Database *database) :
    MyList(parentFenetre, database)
{
    this->setWindowTitle("liste des salles");
    showList();
}

void ListSalle::showList(){

    if(db->getDB().isOpen()){

        QSqlQuery queryPromos;
        queryPromos.prepare("SELECT * FROM Salle;");
        queryPromos.exec();

        QStandardItemModel *model = new QStandardItemModel();
        while (queryPromos.next()) {
            qDebug() << "ListClasse::showList() > ajout d'une salle.";
            QStandardItem *itemClasse = new QStandardItem();
            itemClasse->setText( queryPromos.value(1).toString() );
            itemClasse->setFlags(itemClasse->flags() & ~Qt::ItemIsEditable);
            model->appendRow(itemClasse);
        }
        myTreeList->setModel(model);
    }

}
